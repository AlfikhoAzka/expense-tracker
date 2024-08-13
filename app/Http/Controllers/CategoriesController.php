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

    public function create(Categories $categories)
    {
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $categories = Categories::create(request()->all());

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(Categories $category)
    {
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
