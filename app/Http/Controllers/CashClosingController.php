<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;
use App\Models\CashClosing;
use Illuminate\Support\Facades\Auth;

class CashClosingController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date'
        ]);
        $date = $request->input('date', Carbon::today()->toDateString());

        //$sales = Sale::whereDate('created_at', $date)->get();
        $sales = Sale::with('product')
            ->whereDate('created_at', $date)
            ->get();

        $total = $sales->sum('total'); // asegúrate que tengas este campo
        $count = $sales->count();

        return view('cash_closing.index', compact('sales', 'total', 'count', 'date'));
    }
    public function store(Request $request)
    {
        $date = now()->toDateString();

        // ❗ evitar duplicados
        if (CashClosing::where('date', $date)->exists()) {
            return back()->with('error', 'Ya se realizó el cierre de hoy');
        }

        $sales = Sale::whereDate('created_at', $date)->get();

        $total = $sales->sum('total');
        $count = $sales->count();

        CashClosing::create([
            'date' => $date,
            'total' => $total,
            'sales_count' => $count,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Cierre de caja realizado');
    }
}