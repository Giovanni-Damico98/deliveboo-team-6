@extends('layouts.admin')
@vite('resources/css/dishes/index.css')

@section('content')
    <div class="container-fluid d-flex justify-content-center flex-column align-items-center">
        <div class="d-flex w-100 justify-content-center">
            <a href="{{ route('admin.dishes.create') }}" class="btn btn-success p-2 w-25 fs-2">
                Crea un nuovo piatto
            </a>
        </div>
        <div class="row mb-2 w-75">
            <div class="container my-5">
                <div
                    class="header-of-table col d-flex align-items-center p-4 justify-content-center text-white rounded-top-5">
                    <h1 class="m-0">Gestisci i tuoi piatti</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrizione</th>
                                    <th scope="col">Prezzo</th>
                                    <th scope="col">Azioni</th>

                                </tr>
                            </thead>
                            @forelse ($dishes as $index => $dish)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $dish->id }}</th>
                                        <td>{{ $dish->name }}</td>
                                        <td>{{ substr($dish->description, 0, 60) . (strlen($dish->description) > 50 ? '...' : '') }}
                                        </td>
                                        <td>{{ $dish->price }}</td>
                                        <td>
                                            <a href="{{ route('admin.dishes.edit', $dish) }}"><button
                                                    class="bg-warning p-2 rounded-2 fw-semibold border-0 mb-1">Edit</button></a>
                                            <form class="mb-0" action="{{ route('admin.dishes.delete', $dish) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Elimina"
                                                    class="btn btn-danger p-2 rounded-2 fw-semibold border-0 text-black">
                                            </form>
                                        </td>

                                    </tr>
                                </tbody>
                            @empty
                                <div>
                                    <h1>Non ci sono piatti</h1>
                                </div>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
