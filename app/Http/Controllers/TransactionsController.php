<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    public function index(Category $category)
    {
        $transactions = Transaction::byCategory($category)->get();

        return view('transactions.index', compact('transactions'));
    }

    public function store()
    {
        Transaction::create(request()->all());
        return redirect('/transactions');
    }
}