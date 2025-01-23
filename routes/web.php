<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExpenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CorsMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('categories',[CategoryController::class,'index'])->name('categories.index');
  
Route::get('categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('categories/create',[CategoryController::class,'save'])->name('categories.save');
Route::get('categories/{id}/edit',[CategoryController::class,'edit'])->name('categories.edit');
Route::put('categories/{id}/edit',[CategoryController::class,'update'])->name('categories.update');
Route::delete('categories/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');

Route::get('categories/fetch', [CategoryController::class, 'fetch'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('expenses', [ExpenseController::class, 'index'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('expenses/create', [ExpenseController::class, 'create'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);   
Route::delete('expenses/{id}/delete', [ExpenseController::class, 'delete'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('expenses/summary', [ExpenseController::class, 'summarizeExpenses'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
