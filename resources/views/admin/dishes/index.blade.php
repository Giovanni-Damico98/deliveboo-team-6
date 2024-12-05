@extends('layouts.admin')
@vite('resources/js/delete.js')
@section('content')

<div class="container mt-4">
    <table class="table table-dark table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Prezzo</th>
                <th>Disponibile</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dishes as $dish)
            <tr>
                <td>{{ $dish->name }}</td>
                <td>{{ $dish->description }}</td>
                <td>€{{($dish->price) }}</td>
                <td>
                    @if($dish->visible)
                        <span class="badge bg-success">Disponibile</span>
                    @else
                        <span class="badge bg-danger">Non disponibile</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-warning btn-sm">Modifica</a>

                    <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $dish->id }})">Elimina</button>

                    <form id="delete-form-{{ $dish->id }}" action="{{ route('admin.dishes.delete', $dish->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    @if($dish->visible)
                        <a href="{{ route('admin.dishes.toggle', $dish->id) }}" class="btn btn-secondary btn-sm">Metti fuori menù</a>
                    @else
                        <a href="{{ route('admin.dishes.toggle', $dish->id) }}" class="btn btn-primary btn-sm">Inserisci nel menù</a>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
