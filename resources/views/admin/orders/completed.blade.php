@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-center">Ordini Completati</h1>
    <p class="text-center">Ordini completati: {{ $completedCount }}</p>

    <div class="text-center mb-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Torna agli ordini attivi</a>
    </div>


    @if($completedCount == 0)
        <p class="text-center text-secondary">Nessun ordine completato.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Ordine numero</th>
                    <th>Nome cliente</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completedOrders as $order)
                    <tr>
                        <td>{{$order->formatted_created_at}}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
