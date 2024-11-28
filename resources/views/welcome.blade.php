<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <style>
        /* Custom styling for product cards */
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-image {
            object-fit: cover;
            height: 200px;
            width: 100%;
        }

        /* Sticky footer */
        html, body {
            height: 100%;
            margin: 0;
        }
        .content {
            min-height: 100%;
            padding-bottom: 60px; /* Add space for the footer */
        }
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">My Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Filters -->
    <div class="container my-4">
    <h4>Filtrează după Categorie</h4>
    <ul class="list-group">
        @foreach ($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('products.welcome', ['category' => $category->id]) }}" class="text-decoration-none">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


    <!-- Main Content -->
    <div class="container my-5 content">
        <h1 class="text-center mb-5">Our Products</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="product-card card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="text-muted">Categorie: {{ $product->category->name }}</p>
                            <p class="text-danger fw-bold">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} My Shop. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
