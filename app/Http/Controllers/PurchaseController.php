<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function store(Request $request, $productId)
{
    Log::info('Purchase store method hit', ['product_id' => $productId]);

    $user = Auth::user();
    $product = Product::findOrFail($productId);

    // rest of your logic...

    $purchase = Purchase::create([
        'user_id'     => $user->id,
        'product_id'  => $product->id,
        'quantity'    => 1,
        'total_price' => $product->price,
    ]);

    Log::info('Purchase saved', ['purchase_id' => $purchase->id]);

    return redirect()->route('purchases.index')->with('success', 'Purchase completed successfully.');
}
    

    public function myPurchases()
    {
        
        $user = auth()->user();
    
        // نجيب المشتريات مع تحميل المنتجات معاً (Eager loading)
        $purchases = $user->purchases()->with('product')->paginate(10);
        // dd($purchases);

        return view('purchases.index', compact('purchases'));
    }
    
}
