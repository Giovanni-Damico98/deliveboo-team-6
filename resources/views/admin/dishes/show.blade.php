@extends("layouts.app")

@section("page-title", "Piatto {{$dish->name}}")

@section("main-content")
<h1 class="text-center text-white mb-4">
    Piatto {{$dish["name"]}}
</h1>
<div class="container">
    <div class="row mb-2">
        <div>
            <img src="{{$dish["image"]}}" class="pt-2" alt="...">
            <div class="card-body">
            <h1 class="card-text">Nome: {{ $dish["name"] }}</h1>
            <p class="card-text">Descrizione: {{ $dish["description"] }}</p>
            <p class="card-text"><strong> Prezzo: $ {{ $dish["price"] }} </strong></p>
            </div>
        </div>
        <a class="btn btn-secondary mb-2" href="{{route("admin.dishes.index") }}">
            Torna al menù
        </a>
    </div>
</div>
@endsection
