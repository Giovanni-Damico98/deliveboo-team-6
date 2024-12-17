@extends('layouts.admin')
@vite('resources/sass/chart.scss')
@vite('resources/css/dishes/show.css')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Ordini al Mese/Anno</h1>

    @if(!$hasData)
        <div class="alert alert-warning text-center">
            Nessuna statistica da visualizzare. Completa almeno un ordine.
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="chart-container">
                    <x-chartjs-component :chart="$chart" />
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
