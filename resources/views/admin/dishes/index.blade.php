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
        </div>
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h5 class="card-title mb-0">Lista Piatti</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered">
                        <thead>
                            <tr>
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
                                    <td class="custom-td text-center px-2" >
                                        <img src="{{ asset("storage/". $dish->image)  }}" alt="{{$dish->name}}" class="custom-img img-fluid">
                                        </img>
                                    </td>
                                    <td class="align-middle">{{ $dish->name }}</td>
                                    <td class="align-middle">€{{ number_format($dish->price, 2) }}</td>
                                    <td class="text-center align-middle">
                                        @if ($dish->visible)
                                            <span class="badge bg-success fs-5">Disponibile</span>
                                        @else
                                            <span class="badge bg-danger fs-5">Non disponibile</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <a href="{{ route('admin.dishes.edit', $dish->id) }}"
                                                class="btn btn-warning btn-sm w-100">
                                                <i class="bi bi-pencil-square"></i> Modifica
                                            </a>

                                            @if ($dish->visible)
                                            <button class="btn btn-secondary btn-sm w-100 " data-bs-toggle="modal" data-bs-target="#toggleMenuModal-{{$dish->id}}">
                                                    <i class="bi bi-eye-slash"></i> Metti fuori menù
                                                </button>
                                            @else
                                                <button data-bs-toggle="modal" data-bs-target="#toggleMenuModal-{{$dish->id}}"
                                                    class="btn btn-primary btn-sm w-100">
                                                    <i class="bi bi-eye"></i> Inserisci nel menù
                                                </button>
                                            @endif
                                            <button class="btn btn-danger btn-sm w-100"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal-{{$dish->id}}">
                                                <i class="bi bi-trash"></i> Elimina
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <!-- Modal Elimination -->
                            <div class="modal fade text-dark" id="deleteModal-{{$dish->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$dish->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModal-{{$dish->id}}">Conferma Eliminazione</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                                    </div>
                                    <div class="modal-body">
                                     Sei sicuro di voler eliminare il piatto {{$dish->name}}
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form id="delete-form-{{ $dish->id }}"
                                        action="{{ route('admin.dishes.delete', $dish->id) }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>


                            <!-- Modal Toggle visibility -->
                            <div class="modal fade text-dark" id="toggleMenuModal-{{$dish->id}}" tabindex="-1" aria-labelledby="toggleMenuModalLabel-{{$dish->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="toggleMenuModalLabel-{{$dish->id}}">Conferma Cambio</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                                    </div>
                                    <div class="modal-body">
                                         @if ($dish->visible)
                                             Sei sicuro di voler mettere il piatto {{ $dish->name }} fuori dal menù?
                                         @else
                                            Sei sicuro di voler inserire il piatto {{ $dish->name }} nel menù?
                                         @endif
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('admin.dishes.toggle', $dish->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            @if ($dish->visible)
                                                Metti fuori menù
                                            @else
                                                Inserisci nel menù
                                            @endif
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
    </div>
    @endif
@endsection
