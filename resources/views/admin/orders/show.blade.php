@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center">Ordine {{$order->id}}</h1>
    <p><a class="fs-4 text-center btn btn-sm btn-secondary" href="{{route('admin.orders.index')}}">Torna agli ordini</a></p>

    {{-- @if(session('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif --}}

    <table class="table">
            <tr>
                <th>Data</th>
                <td>{{$order->formatted_created_at}}</td>
            </tr>
            <tr>
                <th>Nome cliente</th>
                <td>{{ $order->firstname }} {{ $order->lastname }}</td>
            </tr>
            <tr>
                <th>Indirizzo</th>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <th>Numero di telefono</th>
                <td>{{ $order->phone_number }}</td>
            </tr>
            <tr>
                <th>Note</th>

                <td>{{ $order->note }}</td>
            </tr>
            <tr>
                <th>Prezzo totale (€)</th>
                <td>{{ number_format($order->total_price, 2, '.', '') }}</td>
            </tr>
            <tr>
                @php
                $dishesCount = [];
                foreach ( $order->dishes as $dish ){
                    $dishesCount[$dish->id][] = $dish;
                }
                @endphp
                <th>Piatti ordinati</th>
                <td>
                    <ul>
                        @foreach ($dishesCount as $dishId => $dishesGroup)
                            @php
                                $dishName = $dishesGroup[0]->name;
                                $quantity = count($dishesGroup);
                            @endphp
                            <li>{{ $dishName }} x {{ $quantity }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
    </table>
</div>
@endsection

