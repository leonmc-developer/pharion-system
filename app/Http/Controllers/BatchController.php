<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Batch;


class BatchController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('batches.create', compact('products'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
        ]);

        Batch::create($request->all());

        return redirect()->back()->with('success', 'Lote registrado correctamente');
    }
}
