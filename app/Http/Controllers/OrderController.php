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

        return response()->json([
            'message' => 'Ordine creato con successo!',
            'order_id' => $order->id
        ], 201);
    }

    public function completed()
    {
        $completedOrders = Order::onlyTrashed()->with('dishes')->get();
        $completedCount = $completedOrders->count();
        return view('admin.orders.completed', compact('completedOrders', 'completedCount'));
    }

    public function complete(Order $order)
    {

        $order->delete();

        return redirect()->route('admin.orders.index')->with('status', 'Ordine completato con successo!');
    }

    public function showChart()
    {

        $start = Carbon::parse(Order::min("created_at"));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 day", $end);

        $ordersPerDay = collect($period)->map(function ($date) {
            $endDate = $date->copy()->endOfDay();

            return [
                "count" => Order::where("created_at", "<=", $endDate)->count(),
                "day" => $endDate->format("Y-m-d")
            ];
        });

        $data = $ordersPerDay->pluck("count")->toArray();
        $labels = $ordersPerDay->pluck("day")->toArray();

        $chart = Chartjs::build()
            ->name("OrdersCharts")
            ->type("line")
            ->size(["width" => 400, "height" => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Orders",
                    "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                    "borderColor" => "rgba(38, 185, 154, 0.7)",
                    "data" => $data
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'day'
                        ],
                        'min' => $start->format("Y-m-d"),
                    ]
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Daily Orders'
                    ]
                ]
            ]);

        return view("admin.orders.chart", compact("chart"));

    }
}
