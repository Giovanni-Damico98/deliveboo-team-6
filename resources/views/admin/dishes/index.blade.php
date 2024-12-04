@extends('layouts.admin')
@vite('resources/css/dishes/index.css')

@section('content')
    <div class="container-fluid mt-1 w-100 d-flex justify-content-center flex-column align-items-center">
        <div class="new-dish d-flex w-100 justify-content-center mb-3">
            <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary m-3 w-25">
                Crea un nuovo piatto
            </a>
        </div>
        <div class="row mb-2 w-75">
            @forelse ($dishes as $index => $dish)
                <div class="col-md-4">
                    <div class="card card-overlay mb-4" style="background-image: url('{{ asset($dish->image) }}');">
                        <div class="card-body">
                            <h2 class="card-title text-white">{{ $dish->name }}</h2>
                            <p class="card-text text-white">
                                {{ substr($dish->description, 0, 60) . (strlen($dish->description) > 50 ? '...' : '') }}
                            </p>

                            <p class="card-text text-end text-white"><strong> Prezzo: €{{ $dish->price }} </strong></p>
                            <div class="action-div w-100">
                                <a class="btn btn-primary mb-2 w-100" href="{{ route('admin.dishes.show', $dish) }}">
                                    Guarda il piatto
                                </a>
                                <a class="btn btn-warning mb-2 w-100" href="{{ route('admin.dishes.edit', $dish) }}">
                                    Modifica il piatto
                                </a>
                                <form action="{{ route('admin.dishes.delete', $dish) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Elimina" class="btn btn-danger mb-2 w-100">
                                </form>
                            </div>
                        </div>
                        <div class="card-overlay"></div>
                    </div>
                </div>
            @empty
                <div>
                    <h1>Non ci sono piatti</h1>
                </div>
            @endforelse
        </div>
    </div>
@endsection
