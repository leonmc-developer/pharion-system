<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Batch;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
        ]);

        // 1. Registrar compra
        $purchase = Purchase::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
        ]);

        // 2. Crear batch automáticamente
        Batch::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
        ]);

        return redirect()->back()->with('success', 'Compra registrada y lote creado');
    }
}
