<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class OrderConfirmationController extends Controller
{
    //
    public function sendOrderConfirmation(Request $request)
{
    $order = [
        'customer_name' => $request->customer_name,
        'order_number' => $request->order_number,
        'items' => $request->items, // Example: [{name: "Item 1", quantity: 1, price: 100}]
        'total' => $request->total,
        'email' => $request->email
    ];

    Mail::to($order['email'])->send(new OrderConfirmation($order));

    return response()->json(['message' => 'Order confirmation email sent!']);
}
}
