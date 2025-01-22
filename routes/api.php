<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;



// Define API routes within the 'api' prefix

Route::prefix('api')->group(function () {
Route::get('expenses', [ExpenseController::class, 'index']); 
Route::post('expenses/create', [ExpenseController::class, 'create']);         
Route::put('expenses/{id}/edit', [ExpenseController::class, 'update']);     
Route::delete('expenses/{id}/delete', [ExpenseController::class, 'delete']); 
Route::get('expenses/summary', [ExpenseController::class, 'summarizeExpenses']);
Route::get('categories/fetch', [CategoryController::class, 'fetch']);
})

    ?>