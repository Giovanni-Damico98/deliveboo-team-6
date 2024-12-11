@extends('layouts.admin')
@vite('resources/css/dishes/create.css')


@section('content')
    <div class="container">
        <h1>Thank you for your order, {{ $order->customer_name }}!</h1>
        <p>Your order #{{ $order->order_number }} has been received and is being processed.</p>

        <h3>Order Details:</h3>
        <ul>
            @foreach ($order->items as $item)
                <li>{{ $item->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->price }}</li>
            @endforeach
        </ul>

        <p><strong>Total:</strong> ${{ $order->total }}</p>
        <p>We will notify you once your order is shipped.</p>

        <p>Thank you for shopping with us!</p>
    </div>
@endsection
