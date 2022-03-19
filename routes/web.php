<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transactions/create', [TransactionsController::class, 'create']);
Route::get('/transactions/{category?}', [TransactionsController::class, 'index']);
Route::get('/transactions/{transaction}', [TransactionsController::class, 'edit']);
Route::post('/transactions', [TransactionsController::class, 'store']);
Route::put('/transactions/{transaction}', [TransactionsController::class, 'update']);
Route::delete('/transactions/{transaction}', [TransactionsController::class, 'destroy']);

Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'store']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');