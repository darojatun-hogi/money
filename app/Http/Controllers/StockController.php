<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockIndicator;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $stock_indicators = StockIndicator::query()
            ->select([
                'id',
                'stock_summary_id',
                'trade_date',
                'stock_code',
                'swing_score',
                'bearish_score',
                'bow_score',
                'signal_tags',
            ])
            ->with('stock_summary:id,close')
            ->when($filters['search'] ?? null, fn ($query, $search) => $query->where('stock_code', 'like', '%'.$search.'%'))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->whereDate('trade_date', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->whereDate('trade_date', '<=', $date))
            ->orderBy('trade_date','desc')
            ->orderBy('swing_score','desc')
            ->orderBy('bearish_score','asc')
            ->orderBy('bow_score','desc')
            ->paginate(50)
            ->withQueryString();

        return view('stock.index',compact('stock_indicators'));
    }
}
