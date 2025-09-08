<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyExpensesChart;

class DashboardController extends Controller
{
    public function index(MonthlyExpensesChart $chart, Request $request)
    {
        $data['chart'] = $chart->build();
        return view('dashboard', ['chart' => $chart->build()]);
    } 
}
