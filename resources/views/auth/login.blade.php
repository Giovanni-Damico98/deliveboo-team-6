@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg mx-auto" style="max-width: 500px;">
            <div class="card-header bg-dark text-white text-center">
                <h2>Login</h2>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Inserisci l'email" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Inserisci la password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ricordami
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Password dimenticata?</a>
                        @endif
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-success">
                            Accedi
                        </button>
                    </div>

                    <p class="text-center text-muted">
                        Non hai un account? <a href="{{ route('register') }}" class="text-decoration-none">Registrati</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
