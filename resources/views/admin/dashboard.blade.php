<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Asigură că pagina ocupă întreaga înălțime */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asigură că ocupă întreaga înălțime a paginii */
        }

        .content {
            flex: 1; /* Ocupă spațiul rămas între navbar și footer */
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger text-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conținut -->
    <div class="container mt-5 content">
        <h1 class="text-center">Bun venit, Admin!</h1>
        <p class="text-center">Gestionează produsele și categoriile din magazin.</p>

        <!-- Adaugă Produs -->
        <div class="d-flex justify-content-between mb-3">
            <h2>Lista Produse</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Adaugă Produs</a>
        </div>

        <!-- Tabel Produse -->
<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Imagine</th>
            <th>Nume</th>
            <th>Descriere</th>
            <th>Preț</th>
            <th>Stoc</th>
            <th>Categorie</th> <!-- Coloana pentru categorie -->
            <th>Acțiuni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Produs" style="width: 100px; height: auto;">
                    @else
                        <span>Fără imagine</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ number_format($product->price, 2) }} RON</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category ? $product->category->name : 'Fără categorie' }}</td> <!-- Afișează numele categoriei -->
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editează</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Șterge</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        <!-- Adaugă Categorie -->
        <div class="d-flex justify-content-between mb-3 mt-5">
            <h2>Lista Categorii</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Adaugă Categorie</a>
        </div>
        <!-- Tabel Categorii -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nume Categorie</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
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

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Admin Dashboard - Gestionare eCommerce</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
