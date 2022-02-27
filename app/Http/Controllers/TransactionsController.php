<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact($transactions));
    }
}