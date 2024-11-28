@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editează Categorie</h1>

        <!-- Formular de editare categorie -->
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nume Categorie</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descriere</label>
                <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizează Categorie</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
