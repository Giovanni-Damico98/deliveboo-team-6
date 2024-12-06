@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card bg-dark text-white border-0">
            <div class="card-body d-flex flex-column justify-content-between"
                style="background-image: url('{{ asset('storage/' . $restaurant->image) }}'); background-size: cover; background-position: center; height: 600px; border-radius: 12px;">
                <div class="bg-overlay p-4 " style="background-color: rgba(0, 0, 0, 0.6); border-radius: 12px; height: 100%;">
                    <h1 class="card-title fw-bold text-center mb-3">{{ $restaurant->name }}</h1>
                    <p class="text-center fs-5">
                        Organizza i tuoi piatti, i tuoi ordini e le statistiche, tramite i link sulla Navbar
                    </p>
                    <div class="text-center mt-4">
                        <div>
                            <p class="mb-0">P. IVA:</p>
                            <strong>{{ $restaurant->vat_number }}</strong>
                        </div>
                        <p class="mb-0">Categorie:</p>
                        @foreach ($restaurant->categories as $item)
                            <div>
                                <strong>{{ $item->name }}</strong>
                            </div>
                        @endforeach
                        <div>
                            <p class="mb-0">Indirizzo:</p>
                            <strong>{{ $restaurant->address }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
