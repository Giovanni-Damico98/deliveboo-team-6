@extends('layouts.app')
{{-- collego il file login.css per l'estetica di login.blade.php --}}
@vite('resources/css/login.css')
{{-- collego il file login.js per le animazioni di login.blade.php --}}
@vite('resources/js/login.js')

@section('content')
    <section class="section-container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                    alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="text" id="email" placeholder="EMAIL" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                        autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="password" id="password" placeholder="PASSWORD" name="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button class="opacity" type="submit">ACCEDI</button>
                </form>
                <div class="register-forget opacity">
                    <a href="{{ route('register') }}">REGISTRATI</a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">RECUPERA PASSWORD</a>
                    @endif
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
@endsection
