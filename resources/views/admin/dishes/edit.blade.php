@extends('layouts.admin')
@vite('resources/css/dishes/edit.css')


@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">Modifica</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Nome del Piatto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $dish->description }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-bold">Prezzo</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                value="{{ $dish->price }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="visible" class="form-label fw-bold">Visibilità</label>
                            <select class="form-select" name="visible" id="visible" required>
                                <option value="1" {{ $dish->visible == 1 ? 'selected' : '' }}>Visibile</option>
                                <option value="0" {{ $dish->visible == 0 ? 'selected' : '' }}>Non Visibile</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">URL Immagine</label>
                        <input type="url" class="form-control" id="image" name="image"
                            value="{{ $dish->image }}">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">Salva Modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
