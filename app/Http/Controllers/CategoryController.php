<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatergoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }
}
