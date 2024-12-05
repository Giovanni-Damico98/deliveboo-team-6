@extends('layouts.admin')
@vite('resources/css/dishes/create.css')


@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h2>Aggiungi</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h4 class="text-danger">Oops!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nome</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name', '') }}" placeholder="Inserisci il nome del piatto" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-bold">Prezzo</label>
                            <input type="number" name="price" class="form-control" id="price" min="0.1"
                                max="999" step="0.01" value="{{ old('price', '') }}" placeholder="Es. 12.99" required>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label fw-bold">Descrizione</label>
                            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Descrivi il piatto"
                                required>{{ old('description', '') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Immagine del Piatto</label>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label for="visible" class="form-label fw-bold">Visibilità</label>
                            <select class="form-select" name="visible" id="visible" required>
                                <option value="1" {{ old('visible') == 1 ? 'selected' : '' }}>Visibile</option>
                                <option value="0" {{ old('visible') == 0 ? 'selected' : '' }}>Non visibile</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success px-5">Crea</button>
                        <button type="reset" class="btn btn-warning px-5">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
