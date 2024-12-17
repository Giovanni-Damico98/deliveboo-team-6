<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Http\Request;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    //
    public function index(Order $orders, Dish $dishes)
    {

        $orders = Order::with('dishes')->get();
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $orders = Order::where('restaurant_id', $restaurant->id)->get();
        $orderCount = $orders->count();

        return view('admin.orders.index', compact('orders', 'orderCount'));
    }

    public function show(Order $order, Dish $dishes)
    {

        // $order = Order::with('dishes')->get();
        // $restaurant = Restaurant::where('user_id', auth()->id())->first();

        // $orders = Order::where('restaurant_id', $restaurant->id)->get();
        return view('admin.orders.show', compact('order', 'dishes'));
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                'restaurant_id' => 'required|integer|exists:restaurants,id',
                'total_price' => 'required|numeric|min:0',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'address' => 'required|string|max:50',
                'phone_number' => 'required|string|regex:/^[0-9\-\+\(\)\s]*$/|max:13',
                'note' => 'nullable|string|max:200',
            ],
            [
                'restaurant_id.exists' => 'Il ristorante selezionato non esiste.',
                'firstname.required' => 'Il nome è obbligatorio.',
                'lastname.required' => 'Il cognome è obbligatorio.',
                'lastname.max' => 'Il cognome non può superare i 255 caratteri.',
                'address.required' => 'L\'indirizzo è obbligatorio.',
                'phone_number.required' => 'Il numero di telefono è obbligatorio.',
                'phone_number.max' => 'Il numero di telefono non può superare i 13 caratteri.',
                'note.max' => 'La nota non può superare i 200 caratteri.',
            ]
        );


        $order = Order::create([
            'restaurant_id' => $request['restaurant_id'],
            'total_price'  => $request['total_price'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number'],
            'note' => $request['note'],
        ]);

        $cart = $request->input('cart', []);

        foreach ($cart as $item) {
            $dishId = $item['id'];
            $quantity = $item['quantity'];

            for ($i = 0; $i < $quantity; $i++) {
                $order->dishes()->attach($dishId);
            }
        }

        Log::info('Evento OrderCreated emesso', ['order_id' => $order->id]);

           // Trigger dell'evento
    event(new OrderCreated($order, $request->email));

        return response()->json([
            'message' => 'Ordine creato con successo!',
            'order_id' => $order->id
        ], 201);
    }

    public function completed()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $completedOrders = Order::onlyTrashed()
            ->where('restaurant_id', $restaurant->id)
            ->with('dishes')
            ->orderBy('created_at', 'desc')
            ->get();

        $lastCompletedOrder = $completedOrders->first();

        $completedCount = $completedOrders->count();

        return view('admin.orders.completed', compact('completedOrders', 'completedCount', 'lastCompletedOrder'));
    }

    public function complete(Order $order)
    {

        $order->delete();

        return redirect()->route('admin.orders.index')->with('status', 'Ordine completato con successo!');
    }

    public function showChart()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $hasData = Order::onlyTrashed()->where('restaurant_id', $restaurant->id)->exists();

        if (!$hasData) {
            return view("admin.orders.chart", ['hasData' => false]);
        }

        $start = Carbon::parse(Order::where('restaurant_id', $restaurant->id)->min("created_at"));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 month", $end);

        $ordersPerMonth = collect($period)->map(function ($date) use ($restaurant) {
            $endDate = $date->copy()->endOfDay();

            return [
                "count" => Order::onlyTrashed()->where("created_at", "<=", $endDate)->where('restaurant_id', $restaurant->id)->count(),
                "month" => $endDate->format("d-m-Y")
            ];
        });

        $count = $ordersPerMonth->pluck("count")->toArray();
        $labels = $ordersPerMonth->pluck("month")->toArray();

        $sellingPerMonth = collect($period)->map(function ($date) use ($restaurant) {
            $endDate = $date->copy()->endOfDay();

            return [
                "summ" => Order::onlyTrashed()->where('restaurant_id', $restaurant->id)->where("created_at", "<=", $endDate)->sum('total_price'),
                "month" => $endDate->format("d-m-Y")
            ];
        });

        $summ = $sellingPerMonth->pluck("summ")->toArray();
        $labels = $sellingPerMonth->pluck("month")->toArray();

        $chart = Chartjs::build()
            ->name("OrdersCharts")
            ->type("bar")       
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Ordini al mese",
                    "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                    "borderColor" => "rgba(38, 185, 154, 0.7)",
                    "data" => $count
                ],
                [
                    "label" => "Vendite al mese €",
                    "backgroundColor" => "rgba(185, 38, 173, 0.31)",
                    "borderColor" => "rgba(48, 38, 185, 0.7)",
                    "data" => $summ
                ],
            ]);

        return view("admin.orders.chart", ['chart' => $chart, 'hasData' => true]);
    }
}