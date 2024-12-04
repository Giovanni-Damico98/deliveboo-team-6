@extends('layouts.admin')
@vite('resources/css/dishes/show.css')


@section('page-title', "Piatto {{ $dish->name }}")

@section('content')
<div class="container">
    <div>
        <h1 class="text-center text-white mt-4 fs-1">
            {{ $dish['name'] }}
        </h1>
    </div>

    <div class="container-fluid w-75">
        <div class="row mb-2">
            <div>
                <div class="card-body d-flex flex-column align-items-center gap-2">
                    <img src="{{ $dish['image'] }}" class="pt-2" alt="...">
                    <p class="card-text text-center text-white fs-4 m-3">{{ $dish['description'] }}</p>
                    <p class="card-text text-white fs-4"><strong> Prezzo: $ {{ $dish['price'] }} </strong></p>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a class="btn btn-primary w-75 m-3 fs-4" href="{{ route('admin.dishes.index') }}">
                    Torna al menù
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
