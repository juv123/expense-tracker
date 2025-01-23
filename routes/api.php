<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExpenseController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories/fetch', [CategoryController::class, 'fetch']);
Route::get('expenses', [ExpenseController::class, 'index']);
Route::get('expenses/searchByDate', [ExpenseController::class, 'getExpensesBetweenDates']);
Route::post('expenses/create', [ExpenseController::class, 'create']) ;   
Route::delete('expenses/{id}/delete', [ExpenseController::class, 'delete']);
Route::get('expenses/summary', [ExpenseController::class, 'summarizeExpenses']);