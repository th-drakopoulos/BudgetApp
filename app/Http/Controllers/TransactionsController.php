<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    public function index(Category $category = null)
    {

        if ($category !== null) {
            $transactions = Transaction::where('category_id', $category->id)->get();
        } else {
            $transactions = Transaction::all();
        }

        return view('transactions.index', compact('transactions'));
    }
}