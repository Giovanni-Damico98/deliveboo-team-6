@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Modifica il Piatto</h1>
        <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome del Piatto</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $dish->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $dish->price }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL Immagine</label>
                <input type="url" class="form-control" id="image" name="image" value="{{ $dish->image }}">
            </div>

            <div class="col mb-3">
                <label class="form-label" for="visible">Visible</label>
                <select class="form-select" name="visible" id="visible" aria-label="Default select example">
                    <option value="1" {{old('visible') == 1 ? 'selected' : ''}}>true</option>
                    <option value="0" {{old('visible') == 0 ? 'selected' : ''}}>false</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
        </form>
    </div>
@endsection
