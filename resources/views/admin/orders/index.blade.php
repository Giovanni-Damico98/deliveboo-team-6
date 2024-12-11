@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center">Ordini</h1>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Ordine numero:
                </th>
                <th>
                    Nome cliente:
                </th>
                <th>
                    Indirizzo:
                </th>
                <th>
                    Numero di telefono:
                </th>
                <th>
                    Note:
                </th>
                <th>
                    Prezzo totale (€)
                </th>
                <th>
                    Piatti ordinati:
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order )
            @php
                $dishesCount = [];
                foreach ( $order->dishes as $dish ){
                    $dishesCount [$dish->id] [] = $dish;
                }
            @endphp
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->firstname }}  {{$order->lastname}}</td>
                <td>{{$order->address}}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->note }}</td>
                <td>{{number_format($order->total_price , 2 , '.' , '' ) }}</td>
                <td>
                    <ul>
                        @foreach ($dishesCount as $dishId => $dishesGroup)
                            @php
                                $dishName = $dishesGroup[0]->name;
                                $quantity = count($dishesGroup)
                            @endphp
                        <li>
                            {{ $dishName }} x {{$quantity}}
                        </li>
                        @endforeach
                    </ul>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
