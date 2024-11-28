<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Afișează lista de produse, cu opțiunea de filtrare după categorie.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Dacă există un parametru de categorie, filtrați produsele
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('admin.dashboard', compact('products', 'categories'));
    }

    /**
     * Afișează formularul pentru adăugarea unui produs nou.
     */
    public function create()
    {
        $categories = Category::all(); // Adăugăm categoriile
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Stochează un produs nou în baza de date.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Validare pentru categoria existentă
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Încarcă imaginea, dacă există
        $imagePath = $request->file('image')
            ? $request->file('image')->store('products', 'public')
            : null;

        // Creează produsul și salvează-l cu categoria aleasă
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->input('category_id'), // Salvează categoria
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produsul a fost adăugat cu succes.');
    }

    /**
     * Afișează formularul de editare pentru un produs existent.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Adăugăm categoriile
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Actualizează produsul specificat.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Validare pentru categoria existentă
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Actualizează imaginea, dacă este încărcată
        if ($request->file('image')) {
            // Șterge imaginea veche, dacă există
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Stochează noua imagine
            $product->image = $request->file('image')->store('products', 'public');
        }

        // Actualizează câmpurile produsului
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id, // Actualizează categoria
            'image' => $product->image, // Păstrează imaginea actualizată sau existentă
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produsul a fost actualizat cu succes.');
    }

    /**
     * Șterge produsul specificat.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Șterge imaginea asociată, dacă există
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Șterge produsul
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Produsul a fost șters.');
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

    return view('products.index', compact('products', 'categories'));
}

}
