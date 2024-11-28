<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Adaugă importul pentru modelul Category
use Illuminate\Support\Facades\Auth;

class ControllerProduse extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // Obține toate produsele cu categoria asociată
        $categories = Category::all(); // Obține toate categoriile
        
        // Dacă utilizatorul este autentificat, trimite produsele și categoriile către dashboard
        if (Auth::check()) {
            return view('dashboard', compact('products', 'categories')); // Trimite produsele și categoriile la dashboard
        }
        
        // Altfel, trimite produsele și categoriile către view-ul "welcome"
        return view('welcome', compact('products', 'categories'));
    }
    public function filterByCategory(Request $request)
    {
        $query = Product::query();
    
        // Filtrare după categorie, dacă parametrul există
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
    
        $products = $query->get();
        $categories = Category::all();
    
        return view('products.welcome', compact('products', 'categories'));
    }
}


