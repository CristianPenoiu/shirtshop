@extends('layouts.admin')

@section('content')
    <h1>{{ isset($product) ? 'Editează Produs' : 'Adaugă Produs' }}</h1>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Nume Produs</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descriere</label>
            <textarea name="description" class="form-control" required>{{ $product->description ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Preț</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stoc</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="image">Imagine</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
    <label for="category_id" class="form-label">Categorie</label>
    <select name="category_id" id="category_id" class="form-select" required>
        <option value="">Selectează o categorie</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
        <button type="submit" class="btn btn-success">{{ isset($product) ? 'Actualizează' : 'Adaugă' }}</button>
    </form>
@endsection
