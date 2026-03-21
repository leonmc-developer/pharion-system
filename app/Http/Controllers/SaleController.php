<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // 🔴 VALIDAR STOCK
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stock insuficiente');
        }

        // 💰 CALCULAR TOTAL
        $total = $product->price * $request->quantity;

        // 🟢 REGISTRAR VENTA
        Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total' => $total
        ]);

        // 🔻 DESCONTAR STOCK
        $product->decrement('stock', $request->quantity);

        return back()->with('success', 'Venta registrada correctamente');
    }
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();

        return view('sales.create', compact('products'));
    }
}
