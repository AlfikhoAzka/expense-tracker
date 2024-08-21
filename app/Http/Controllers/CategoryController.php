<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create(Category $categories)
    {
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);
        $categories = Category::create(request()->all());

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, Category $categories)
    {
        $request->validate([
            'categories' => 'required|string|max:255',
        ]);
        $categories->update($request->all());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $categories)
    {
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
