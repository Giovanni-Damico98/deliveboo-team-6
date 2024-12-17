@extends('layouts.admin')

@section('content')
<h1>E' arrivato un nuovo ordine da parte di {{ $order->firstname }}!</h1>
<p>Controlla il tuo pannello di amministrazione</p>
@endsection
