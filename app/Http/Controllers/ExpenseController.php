<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Categories;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $sortBy = $request->query('sort_by', 'created_at');
        $sortOrder = $request->query('sort_order', 'desc');

        $expenses = Expense::with('category')
        ->search($search)
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
    public function create(expense $expense, Categories $categories)
    {

        $categories = Categories::all();
        return view('expenses.create', compact('expense', 'categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required|numeric',
        ]);
        $expense = Expense::create(request()->all());

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense, Categories $categories)
    {
        $categories = Categories::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
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
