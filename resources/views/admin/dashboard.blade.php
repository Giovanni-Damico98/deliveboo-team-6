@extends('layouts.admin')

@section('content')
    <h1>Benvenuto nella dashboard del ristorante {{ $restaurant->name }}</h1>
    <p> Indirizzo: {{ $restaurant->address }} </p>
    <p> P.iva: {{ $restaurant->vat_number }} </p>
    <p> <img src="{{ $restaurant->image }}" alt="{{ $restaurant->name }}"></p>
    <p>Organizza i tuoi piatti, i tuoi ordini e le statistiche dal menù in alto</p>
@endsection
