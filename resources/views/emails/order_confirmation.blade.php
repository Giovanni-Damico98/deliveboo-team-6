@extends('layouts.admin')

@section('content')
<h1>Grazie per averci scelto, {{ $order->firstname }}!</h1>
<p>Il tuo ordine è stato confermato con successo, e sarà presto inviato al tuo indirizzo. Totale: €{{ $order->total_price }}</p>
@endsection
