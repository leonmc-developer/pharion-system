<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;

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
}