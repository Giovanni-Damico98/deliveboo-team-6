@extends("layouts.admin")
@section("content")
<main class="container">
    <div class="card-title mb-5">
        <h1>Aggiungi Piatto</h1>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Some field are invalid</h4>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('admin.dishes.store')}}" method="POST">
            @csrf
            <div class="row mb-3">
                {{-- <div class="col mb-3">
                    <label class="form-label" for="restaurant_id">Restaurant</label>
                    <select class="form-select" name="restaurant_id" id="restaurant_id" aria-label="Default select example">
                        <option value="">Selezione il ristorante</option>
                        @foreach($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name', '')}}" placeholder="name">
                </div>
                <div class="col-8 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" name="description" class="form-control" id="description">{{old('description', '')}}</textarea>
                </div>
                <div class="col-2 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="price" min="0" max="999" value="{{old('price', '')}}">
                </div>
                <div class="col mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="url" name="image" class="form-control" id="image" value="{{old('image', '')}}">
                </div>
                <div class="col mb-3">
                    <label class="form-label" for="visible">Visible</label>
                    <select class="form-select" name="visible" id="visible" aria-label="Default select example">
                        <option value="1" {{old('visible') == 1 ? 'selected' : ''}}>true</option>
                        <option value="0" {{old('visible') == 0 ? 'selected' : ''}}>false</option>
                    </select>
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
