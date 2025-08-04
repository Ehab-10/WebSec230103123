<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products with search
  public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    if ($request->filled('sort_by')) {
        switch ($request->sort_by) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
        }
    } else {
        $query->latest();
    }

    $products = $query->paginate(10);

    return view('products.index', compact('products'));
}


    // Show form to create a new product
    public function create()
    {
        return view('products.create');
    }
public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

    // Store a newly created product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->only(['name', 'description', 'price']));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show form to edit an existing product
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update an existing product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->only(['name', 'description', 'price']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
