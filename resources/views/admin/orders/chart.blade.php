@extends('layouts.admin')
@vite('resources/sass/chart.scss')
@vite('resources/css/dishes/show.css')

@section('content')
<div class="container">
    <h1>Ordini al Mese/Anno</h1>
    <div style="width:75%;">
        <x-chartjs-component :chart="$chart" />
    </div>
</div>
@endsection
