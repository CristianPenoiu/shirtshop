@extends('layouts.admin')

@section('content')
    <h1>Produse</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Adaugă Produs</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nume</th>
                <th>Preț</th>
                <th>Stoc</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editează</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Șterge</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
