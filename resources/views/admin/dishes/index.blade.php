@extends("layouts.admin")

@section("content")

<div class="container">
    {{-- <a href="{{ route("admin.dishes.create") }}" class="btn btn-primary m-3 d-flex justify-content-center align-content-center">
        Crea un nuovo piatto
    </a> --}}
    <div class="row mb-2">
    @forelse ($dishes as $index => $dish )
        <div style="width: 18rem;">
            <img src="{{$dish->image}}" class="card-img-top pt-2" alt="...">
            <div class="card-body">
            <h1 class="card-text">{{ $dish->id}} Piatto:  {{ $dish->name }}</h1>
            <p class="card-text">Descrizione: {{ $dish->description }}</p>
            <p class="card-text"><strong> Prezzo: $ {{ $dish->price }} </strong></p>
             <a class="btn btn-secondary mb-2" href="{{route("admin.dishes.show" , $dish) }}">
                Guarda il piatto
            </a>
            <a class="btn btn-secondary mb-2" href="{{route("admin.dishes.edit" , $dish) }}">
                Modifica il piatto
            </a>
            <form action="{{route("admin.dishes.delete" , $dish) }}"
                 method="post">
            @csrf
            @method("DELETE")
                <input type="submit" value="Elimina" class="btn btn-danger mb-2">
            </form>
            </div>
        </div>
    @empty
        <div>
            <h1>
                Non ci sono piatti
            </h1>
        </div>
    @endforelse
    </div>
</div>
