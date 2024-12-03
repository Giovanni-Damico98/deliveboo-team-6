@extends("layouts.app")
@section("content")
<main class="container">
    <div class="card-title mb-5">
        <h1>Aggiungi Piatto</h1>
    </div>
    <div class="card-body">
        <form action="{{route('admin.dishes.store')}}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name', '')}}" placeholder="name">
                </div>
                <div class="col-8 mb-3">
                    <label for="description" class="form-label">Image</label>
                    <input type="url" name="description" class="form-control" id="description" value="{{old('description', '')}}">
                </div>
                <div class="col-2 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="price" min="0" value="{{old('price', '')}}">
                </div>
                <div class="col mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="url" name="image" class="form-control" id="image" value="{{old('image', '')}}">
                </div>
            </div>
            <div class="d-flex justify-content-around">
                <button type="submit" class="btn btn-success">CREA</button>
                <button type="reset" class="btn btn-warning">RESET</button>
            </div>
        </form>
    </div>
</main>
@endsection
