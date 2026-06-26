<?php

namespace App\Http\Controllers;

use App\Production;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $line = $request->input('line');

        $query = Production::query()
            ->whereBetween('production_date', ['2026-01-01', '2026-01-31'])
            ->when(
                $request->filled('line'),
                function ($query) use ($line) {
                    $query->where('product_line', $line);
                }
            );

        /*
        |--------------------------------------------------------------------------
        | Cards
        |--------------------------------------------------------------------------
        */

        $totalProduced = (clone $query)
            ->sum('produced_quantity');

        $totalDefects = (clone $query)
            ->sum('defect_quantity');

        $averageEfficiency = $totalProduced > 0
            ? round(
                (($totalProduced - $totalDefects) / $totalProduced) * 100,
                2
            )
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Gráfico
        |--------------------------------------------------------------------------
        */

        $chart = (clone $query)
            ->selectRaw('product_line, SUM(produced_quantity) as total')
            ->groupBy('product_line')
            ->orderBy('product_line')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Grid
        |--------------------------------------------------------------------------
        */

        $productions = $query
            ->orderBy('production_date', 'desc')
            ->paginate(20)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Combo
        |--------------------------------------------------------------------------
        */

        $lines = Production::query()
            ->whereBetween('production_date', ['2026-01-01', '2026-01-31'])
            ->select('product_line')
            ->distinct()
            ->orderBy('product_line')
            ->pluck('product_line');

        return view('dashboard', [

            'productions' => $productions,

            'lines' => $lines,

            'line' => $line,

            'totalProduced' => $totalProduced,

            'totalDefects' => $totalDefects,

            'averageEfficiency' => $averageEfficiency,

            'chartLabels' => $chart->pluck('product_line'),

            'chartData' => $chart->pluck('total'),

        ]);
    }
}
