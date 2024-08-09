<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $expenses = Category::paginate(10);
        return view ('index', compact('categories'));
    }
}
