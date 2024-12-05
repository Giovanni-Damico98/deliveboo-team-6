@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center">Piatti eliminati</h1>
    @if ($trashedDishes->isEmpty())
        <p>Nessun piatto trovato</p>
    @else
    <table class="table">
        <thead>

            <tr>
                <th>
                    Nome:
                </th>
                <th>
                    Descrzione:
                </th>
                <th>
                    Prezzo:
                </th>
                <th>
                    Cancellato il:
                </th>
                <th>
                    Azione:
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trashedDishes as $dish )
            <tr>
              <td>{{ $dish->name }}</td>
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
