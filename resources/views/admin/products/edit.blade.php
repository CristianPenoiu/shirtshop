@extends('layouts.admin')

@section('title', 'Editare Produs')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Editare Produs</h1>

    <!-- Afișare erori -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formular de editare -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nume Produs</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descriere</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preț</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stoc</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <!-- Select pentru categorie -->
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

        <div class="mb-3">
            <label for="image" class="form-label">Imagine</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Produs" class="img-fluid mt-3" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvează</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Anulează</a>
    </form>
</div>
@endsection
