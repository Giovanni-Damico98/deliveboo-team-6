<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Order $order, Dish $dish){

        $order = Order::with('dish')->findOrFail($dish);

        if (isset($order['dishes'])){
          $order->dishes()->sync($order['dishes']);
        } else{
              $order->dishes()->detach();
        }

        return view('admin.orders.index');

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

      return response()->json([
        'message' => 'Ordine creato con successo!',
        'order_id' => $order->id
    ], 201);

  }

}