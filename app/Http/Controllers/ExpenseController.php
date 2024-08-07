<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $sortBy = $request->query('sort_by', 'name');
        $sortOrder = $request->query('sort_order', 'asc');

        $expenses = Expense::search($search)
        ->when($start_date, function ($query, string $start_date){
            $query->where('created_at', '>', $start_date);
        })
        ->when($end_date, function ($query, string $end_date){
            $query->where('created_at', '<', $end_date);
        })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10)
            ->withQueryString();
        return view('expenses.index', compact('expenses'));
    }
    public function create(expense $expense)
    {
        return view('expenses.create', compact('expense'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        $expense = Expense::create(request()->all());

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
