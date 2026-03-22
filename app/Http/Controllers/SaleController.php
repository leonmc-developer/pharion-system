<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\CashClosing;
use Illuminate\Support\Facades\Auth;


class SaleController extends Controller
{
    public function index()
    {
        $sales = \App\Models\Sale::with('product')
            ->latest()
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }
    public function store(Request $request)
    {
        if (CashClosing::where('date', today())->exists()) {
            return back()->with('error', 'Caja cerrada, no se pueden registrar ventas');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stock insuficiente');
        }

        $total = $product->price * $request->quantity;

        Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total' => $total,
            'user_id' => Auth::id(),
        ]);

        $product->decrement('stock', $request->quantity);

        return back()->with('success', 'Venta registrada correctamente');
    }
    public function create()
    {
         
        $products = Product::where('stock', '>', 0)->get();

        return view('sales.create', compact('products'));
        
    }
}
