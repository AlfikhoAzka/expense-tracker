<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Expense;
class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::paginate(10);
        return view ('index', compact('expenses'));
    }
    public function create(expense $expense)
    {
        return view ('create', compact('expense'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        $expense = Expense::create(request()->all());
        
        return redirect()->route('index')->with('success', 'Product created successfully.');;
    }
}