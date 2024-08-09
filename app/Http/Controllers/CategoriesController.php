<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $categories = Categories::create(request()->all());

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(Categories $categories)
    {
        return view('categories.edit', compact('categories'));
    }
    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $categories->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Categories $categories)
    {
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
