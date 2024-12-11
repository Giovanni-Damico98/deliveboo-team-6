@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center">Ordini</h1>
    @if ($orders->isEmpty())
        <p>Nessun Ordine ricevuto</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>
                    Ordine:
                </th>
                <th>
                    Quantità:
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
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order )
            <tr>
              <td>{{ $order->dishes->name }}</td>
              <td>{{ $dish->description }}</td>
              <td>{{ $dish->price }}</td>
              <td>{{ $dish->deleted_at }}</td>
              <td>
                <form action="{{ route("admin.dishes.restore" , $dish->id )}}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        Ripristina
                    </button>
                </form>
                <form action="{{ route("admin.dishes.forceDelete" , $dish->id )}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger btn-sm">
                        Cancella
                    </button>
                </form>

              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
@endsection
