@extends('layouts.admin')
@vite('resources/js/delete.js')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-black">Gestione Piatti</h1>
            <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Aggiungi Nuovo Piatto
            </a>
        </div>

        <div class="card bg-dark text-white">
            <div class="card-header">
                <h5 class="card-title mb-0">Lista Piatti</h5>
            </div>
            <div class="card-body">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>Prezzo</th>
                            <th>Disponibile</th>
                            <th class="text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dishes as $dish)
                            <tr>
                                <td>{{ $dish->name }}</td>
                                <td>{{ $dish->description }}</td>
                                <td>€{{ number_format($dish->price, 2) }}</td>
                                <td class="text-center">
                                    @if ($dish->visible)
                                        <span class="badge bg-success">Disponibile</span>
                                    @else
                                        <span class="badge bg-danger">Non disponibile</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.dishes.edit', $dish->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Modifica
                                        </a>

                                        @if ($dish->visible)
                                            <a href="{{ route('admin.dishes.toggle', $dish->id) }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="bi bi-eye-slash"></i> Metti fuori menù
                                            </a>
                                        @else
                                            <a href="{{ route('admin.dishes.toggle', $dish->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye"></i> Inserisci nel menù
                                            </a>
                                        @endif
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $dish->id }})">
                                            <i class="bi bi-trash"></i> Elimina
                                        </button>
                                    </div>

                                    <form id="delete-form-{{ $dish->id }}"
                                        action="{{ route('admin.dishes.delete', $dish->id) }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
