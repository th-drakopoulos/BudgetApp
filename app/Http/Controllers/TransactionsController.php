<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Category $category)
    {
        $transactions = Transaction::byCategory($category)->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function store()
    {
        $this->validate(request(), [
            'description' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric',
        ]);
        Transaction::create(request()->all());
        return redirect('/transactions');
    }
}