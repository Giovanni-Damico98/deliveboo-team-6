<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    //
    public function index(Order $orders, Dish $dishes)
    {

        $orders = Order::with('dishes')->get();

        $orderCount = $orders->count();

        return view('admin.orders.index', compact('orders', 'orderCount'));
    }



    public function store(Request $request)
    {

        $request = $request->validate(
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
            'total_price' => $request['total_price'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number'],
            'note' => $request['note'] ?? null,
        ]);

        $cart = $request['cart'];

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
}
