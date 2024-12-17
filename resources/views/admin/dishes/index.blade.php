@extends('layouts.admin')
@vite('resources/css/dashboard/index.css')

@section('content')
    <div class="container mt-4">
        <div class="text-center">
            <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Aggiungi Nuovo Piatto
            </a>
        </div>

        @if ($dishes->count() > 0)
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-black">Gestione Piatti</h1>
                <h1 class="text-black">Piatti trovati {{ $dishes->count() }}</h1>
            </div>

            <div class="card bg-dark text-white">
                <div class="card-header">
                    <h5 class="card-title mb-0">Lista Piatti</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-bordered align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>Immagine</th>
                                    <th>Nome</th>
                                    <th>Prezzo</th>
                                    <th>Disponibile</th>
                                    <th class="text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dishes as $dish)
                                    <tr>
                                        <!-- Immagine ridimensionata -->
                                        <td class="text-center" style="width: 120px;">
                                            <img src="{{ asset("storage/". $dish->image) }}" alt="{{ $dish->name }}"
                                                class="img-thumbnail" style="max-width: 100px; height: auto;">
                                        </td>
                                        <!-- Nome piatto -->
                                        <td class="fw-bold">{{ $dish->name }}</td>
                                        <!-- Prezzo -->
                                        <td class="text-center">€{{ number_format($dish->price, 2) }}</td>
                                        <!-- Stato Disponibilità -->
                                        <td class="text-center">
                                            @if ($dish->visible)
                                                <span class="badge bg-success fs-6">Disponibile</span>
                                            @else
                                                <span class="badge bg-danger fs-6">Non disponibile</span>
                                            @endif
                                        </td>
                                        <!-- Azioni -->
                                        <td class="text-center">
                                            <div class="d-flex flex-column gap-2">
                                                <a href="{{ route('admin.dishes.edit', $dish->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Modifica
                                                </a>

                                                @if ($dish->visible)
                                                    <button class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#toggleMenuModal-{{ $dish->id }}">
                                                        <i class="bi bi-eye-slash"></i> Fuori Menù
                                                    </button>
                                                @else
                                                    <button class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#toggleMenuModal-{{ $dish->id }}">
                                                        <i class="bi bi-eye"></i> Nel Menù
                                                    </button>
                                                @endif

                                                <button class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $dish->id }}">
                                                    <i class="bi bi-trash"></i> Elimina
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Eliminazione -->
                                    <div class="modal fade text-dark" id="deleteModal-{{ $dish->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel-{{ $dish->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Conferma Eliminazione</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuro di voler eliminare il piatto <strong>{{ $dish->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{ route('admin.dishes.delete', $dish->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Toggle Visibility -->
                                    <div class="modal fade text-dark" id="toggleMenuModal-{{ $dish->id }}" tabindex="-1"
                                        aria-labelledby="toggleMenuModalLabel-{{ $dish->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Conferma Cambio Stato</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($dish->visible)
                                                        Sei sicuro di voler mettere il piatto <strong>{{ $dish->name }}</strong> fuori menù?
                                                    @else
                                                        Sei sicuro di voler inserire il piatto <strong>{{ $dish->name }}</strong> nel menù?
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{ route('admin.dishes.toggle', $dish->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ $dish->visible ? 'Fuori Menù' : 'Nel Menù' }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <h5 class="text-center my-3">Non hai ancora inserito dei piatti...</h5>
        @endif
    </div>
@endsection
