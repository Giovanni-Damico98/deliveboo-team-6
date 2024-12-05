@extends('layouts.admin')
@vite('resources/css/admin/dashboard.css')
@section('content')
    <div class="restaurant-card" style="background-image: url('{{ asset($restaurant->image) }}');">
        <div class="restaurant-card-overlay">
            <div class="restaurant-card-content">
                <h1 class="restaurant-title m-2 fs-1">{{ $restaurant->name }}</h1>
                <p class="restaurant-info mt-5">
                    Organizza i tuoi piatti, i tuoi ordini e le statistiche
                </p>
                <div class="link-div d-flex justify-content-around mt-3">
                    <a class="link" href="{{ route('admin.dishes.index') }}">Menù</a>
                    <a class="link" href="#{{-- {{ route('admin.orders.index') }} --}}">Ordini</a>
                    <a class="link" href="#{{-- {{ route('admin.statistics') }} --}}">Statistiche</a>
                </div>

                <div class="card-info d-flex justify-content-between mt-4">
                    <p class="restaurant-vat">P. IVA : <br> {{ $restaurant->vat_number }}</p>
                    <p class="restaurant-address">Indirizzo : <br> {{ $restaurant->address }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
