@extends('layouts.app')
{{-- collego il file register.css per l'estetica di register.blade.php --}}
@vite('resources/css/register.css')

@vite('resources/js/register.js')

@section('content')
    <div class="register-container">
        <!-- Titolo della sezione -->
        <div class="title">Registrazione</div>
        <div class="register-content">
            <!-- Form di registrazione -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Dati dell'utente -->
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nome</span>
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Inserisci il nome" required autocomplete="name"
                            autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">E-mail</span>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"  size="30"
                            value="{{ old('email') }}" placeholder="Inserisci la mail" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror"
                            name="password" placeholder="Inserisci la password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">Conferma Password</span>
                        <input id="password-confirm" type="password" name="password_confirmation"
                            placeholder="Conferma la password" required autocomplete="new-password">
                    </div>
                </div>

                <!-- Dati del ristorante -->
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nome dell'Attività</span>
                        <input id="restaurant_name" type="text" class="@error('restaurant_name') is-invalid @enderror"
                            name="restaurant_name" value="{{ old('restaurant_name') }}" placeholder="Nome dell'attività"
                            required>
                        @error('restaurant_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">Indirizzo dell'Attività</span>
                        <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address"
                            value="{{ old('address') }}" placeholder="Indirizzo dell'attività" required>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">Partita IVA</span>
                        <input id="vat_number" type="text" class="@error('vat_number') is-invalid @enderror"
                            name="vat_number" value="{{ old('vat_number') }}" placeholder="Partita IVA" required>
                        @error('vat_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">Immagine Ristorante</span>
                        <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image" accept="image/*">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Pulsante di registrazione -->
                <div class="button">
                    <input type="submit" value="Registrati">
                </div>
            </form>
        </div>
    </div>
@endsection
