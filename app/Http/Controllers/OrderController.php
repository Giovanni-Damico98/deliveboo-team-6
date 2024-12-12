<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    //
    public function index(Order $orders, Dish $dishes){

        $orders = Order::with('dishes')->get();
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $orders = Order::where('restaurant_id', $restaurant->id)->get();
        $orderCount = $orders->count();

        return view('admin.orders.index' , compact('orders', 'orderCount'));

    }

    public function show (Order $orders, Dish $dishes) {
        $orders = Order::with('dishes')->get();
        return view ('admin.orders.show', compact('orders'));
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $orders = Order::where('restaurant_id', $restaurant->id)->get();
    }



  public function store( Request $request){

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

  public function completed() {
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
