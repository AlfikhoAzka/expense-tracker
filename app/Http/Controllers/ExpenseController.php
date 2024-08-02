<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = Expense::paginate(10);
        return view ('expenses.index', compact('expenses'));
    }

    public function search(Request $request)
    {
        $expenses = Expense::where('name', 1)
                         ->orderBy('name')
                         ->take(10)
                         ->get();

        return view('flights.index', compact('flights'));
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

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');;
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
