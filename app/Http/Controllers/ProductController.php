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
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        $products = $query->paginate(10)->withQueryString();
    
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
    $validated = $request->validate([
        'code' => 'required|string|max:255|unique:products,code',
        'name' => 'required|string|max:255',
        'model' => 'nullable|string|max:255',
        'price' => 'required|numeric',
        'photo' => 'nullable|image|max:2048', // حجم الصورة 2MB كحد أقصى
        'description' => 'nullable|string',
    ]);

    // معالجة رفع الصورة إذا تم تحميلها
    if ($request->hasFile('image')) {
        $fileName = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $fileName);
        $product->image_url = 'storage/products/' . $fileName; 
    }

    Product::create($validated);

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
            'image' => 'nullable|image|max:2048', // 2MB max file size
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $fileName);
            $product->image_url = 'storage/products/' . $fileName; // المسار الصحيح للعرض
        }
        
        

        $product->update($request->only(['name', 'description', 'price', 'image_url']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function purchases()
{
    return $this->hasMany(Purchase::class);
}

public function buy(Request $request, Product $product)
{
    $user = auth()->user();

    if (!$user->hasRole('user')) {
        return back()->with('error', 'Only customers can buy products.');
    }

    if ($user->credit < $product->price) {
        return back()->with('error', 'Insufficient credit to buy this product.');
    }

    if ($product->stock < 1) {
        return back()->with('error', 'Product out of stock.');
    }

    $user->credit -= $product->price;
    $user->save();

    $product->stock -= 1;
    $product->save();

    return back()->with('success', 'Product purchased successfully!');
}

}
