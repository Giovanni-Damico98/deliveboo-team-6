@extends('layouts.app')
{{-- collego il file home.scss per l'estetica di home.blade.php --}}
@vite('resources/css/home.css')
{{-- collego il file home.js per le animazioni di home.blade.php --}}
{{-- @vite('resources/js/home.js') --}}



@section('content')
    <div class="card-container">
        <div class="row justify-content-center">
            <div class="col text-white">
                {{-- Titolo --}}
                <div class=" text-center">
                    <h1 class="home-title fw-bold">Benvenuto!</h1>
                </div>
                <div class="d-flex">

                    <div class="justify-center text-center fs-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- Messaggio centrale homepage --}}

                         <div id="body-text">
                            <p class="mt-4 paragraph">
                                Effettua il login per gestire la sezione relativa al tuo
                                ristorante <br>
                                oppure registrati
                                per inserire la tua attività
                            </p>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
