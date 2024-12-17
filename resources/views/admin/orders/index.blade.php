@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center">Ordini Ricevuti</h1>

    <p class="text-center">Ordini attivi: {{ $orderCount }}</p>

    <div class="text-center mb-3">
        <a href="{{ route('admin.orders.completed') }}" class="btn btn-secondary">Vedi ordini completati</a>
    </div>

    @if($orderCount > 0)

    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Ordine numero</th>
                <th>Mostra Ordine</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order )
                @php
                    $dishesCount = [];
                    foreach ( $order->dishes as $dish ){
                        $dishesCount[$dish->id][] = $dish;
                    }
                @endphp
                <tr>
                    <td>{{$order->formatted_created_at}}</td>
                    <td>{{ $order->id }}</td>
                    <td><a class="btn btn-sm btn-success" href="{{route('admin.orders.show', $order->id)}}">Mostra</a></td>
                    <td>
                        <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success" type="submit">Completa Ordine</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h5 class="text-danger alert alert-danger text-center">
        Non è ancora presente alcun ordine...
    </h5>
    @endif
</div>
@endsection
