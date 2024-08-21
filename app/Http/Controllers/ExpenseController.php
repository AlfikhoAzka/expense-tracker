<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index(Request $request)
{
    $filter = $request->query('filter', 'all');
    $search = $request->input('search');
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $sortBy = $request->query('sort_by', 'created_at');
    $sortOrder = $request->query('sort_order', 'desc');
    $categories = Categories::all();

    $expensesFilter = Expense::with('category')
        ->search($search)
        ->when($start_date, function ($query, string $start_date) {
            $query->where('created_at', '>', $start_date);
        })
        ->when($end_date, function ($query, string $end_date) {
            $query->where('created_at', '<', $end_date);
        })
        ->when($request->filled('category_id'), function ($query) use ($request) {
            $query->withWhereHas('category', function ($query) use ($request) {
                $categories = explode(',', $request->input('category_id'));
                $query->whereIn('id', $categories);
            });
        });

        $totalExpense = 'Rp ' . number_format($expensesFilter->sum('price'), 2, ',', '.');

    $expenses = $expensesFilter
        ->orderBy($sortBy, $sortOrder)
        ->paginate(10)
        ->withQueryString();

    return view('expenses.index', compact('expenses', 'categories', 'totalExpense'));
}
    public function create(expense $expense, Categories $categories)
    {

        $categories = Categories::all();
        return view('expenses.create', compact('expense', 'categories'));
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'nullable',
        'price' => 'required|numeric',
        'image' => 'image|nullable|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $filePath = $request->file('image')->store('images', 'public');
        $validatedData['image'] = $filePath;
    } else {
        $validatedData['image'] = null;
    }

    Expense::create($validatedData);

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
            'category_id' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'image|nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $filePath;
        } else {
            $validatedData['image'] = null;
        }

        $expense->update($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
