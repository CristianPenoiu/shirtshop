<x-app-layout>

<div class="container my-4">
    <h4>Filtrează după Categorie</h4>
    <ul class="list-group">
        @foreach ($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('products.filter', ['category' => $category->id]) }}" class="text-decoration-none">
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
        @forelse ($products as $product)
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
        @empty
            <p class="text-center">Nu există produse pentru această categorie.</p>
        @endforelse
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; {{ date('Y') }} My Shop. All rights reserved.</p>
    </div>
</footer>

<style>
    /* Custom styling for product cards */
    .product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow for card */
    }

    .product-card:hover {
        transform: scale(1.05); /* Hover scale effect */
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
</x-app-layout>

