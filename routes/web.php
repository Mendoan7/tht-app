<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth', 'verified']], function () {

    // product
    Route::resource('product', ProductController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::get('product/export', [ProductController::class, 'exportExcel'])->name('product.export'); 

require __DIR__ . '/auth.php';
