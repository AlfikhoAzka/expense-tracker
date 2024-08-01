<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::paginate(10);
        return view ('expenses.index', compact('expenses'));
    }
    public function create(expense $expense)
    {
        return view ('expenses.create', compact('expense'));
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

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}