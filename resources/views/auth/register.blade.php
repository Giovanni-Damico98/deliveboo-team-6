@extends('layouts.app')
@vite('resources/js/register.js')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark text-white text-center">
                <h2>Registrazione</h2>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <h4 class="text-primary">Dati Utente</h4>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nome</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Inserisci il nome" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Inserisci l'email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Inserisci la password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label fw-bold">Conferma Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="Conferma la password" required>
                        </div>
                    </div>

                    <h4 class="text-primary">Dati Ristorante</h4>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="restaurant_name" class="form-label fw-bold">Nome Attività</label>
                            <input id="restaurant_name" type="text"
                                class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name"
                                value="{{ old('restaurant_name') }}" placeholder="Inserisci il nome dell'attività"
                                required>
                            @error('restaurant_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label fw-bold">Indirizzo</label>
                            <input id="address" type="text"
                                class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address') }}" placeholder="Inserisci l'indirizzo dell'attività"
                                required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="vat_number" class="form-label fw-bold">Partita IVA</label>
                            <input id="vat_number" type="text"
                                class="form-control @error('vat_number') is-invalid @enderror" name="vat_number"
                                value="{{ old('vat_number') }}" placeholder="Inserisci la Partita IVA" required>
                            @error('vat_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label fw-bold">Immagine Ristorante [Massimo 2mb]</label>
                            <input id="image" type="file"
                                class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Categoria ristorante</label>
                            <button type="button" class="btn btn-primary mb-3" id="show-categories-btn">
                                Seleziona Categorie
                            </button>

                            <div id="categories-container" class="d-none">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" class="form-check-input @error('categories') is-invalid @enderror"
                                            {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}>
                                        <label for="category-{{ $category->id }}" class="form-check-label">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('categories')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <p class="text-muted text-center">* Tutti i campi sono obbligatori</p>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success px-5">Registrati</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
