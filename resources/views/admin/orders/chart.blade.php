@extends('layouts.admin')
@vite('resources/sass/chart.scss')
@vite('resources/css/dishes/show.css')

@section('content')
<div class="container">
    <h1>Ordini al Mese/Anno</h1>

    @if(!$hasData)
        <div class="alert alert-warning text-center">
            Nessuna statistica da visualizzare. Completa almeno un ordine.
        </div>
    @else
        <div style="width:75%;">
            <x-chartjs-component :chart="$chart" />
        </div>
    @endif
</div>
@endsection
