<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::paginate();
        return view('categories.index', compact('categories'));
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        Category::create(request()->all());
        return redirect('/categories');
    }

    public function create()
    {
        $category = new Category();
        return view('categories.create', compact('category'));
    }
}