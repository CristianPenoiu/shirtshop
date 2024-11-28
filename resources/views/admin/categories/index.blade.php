@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista Categoriilor</h1>

        <!-- Mesaj de succes -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buton Adaugă Categorie -->
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Adaugă Categorie</a>

        <!-- Tabel Categorii -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nume</th>
                    <th>Descriere</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Editează</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Șterge</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @endsection
