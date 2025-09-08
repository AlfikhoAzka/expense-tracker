<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyExpensesChart;

class DashboardController extends Controller
{
    public function index(MonthlyExpensesChart $chart)
    {
        $data['chart'] = $chart->build();
        $totalExpense = 'Rp ' . number_format(
        \App\Models\Expense::sum('price'), 2, ',', '.');
        return view('dashboard', ['chart' => $chart->build(), 'totalExpense' => $totalExpense,]);
    } 
}
