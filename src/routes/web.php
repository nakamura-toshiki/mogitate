<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/search', [ProductController::class, 'search'])->name('search');
Route::post('/products/register', [ProductController::class, 'store'])->name('register');
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('show');
Route::patch('/products/{productId}/update', [ProductController::class, 'update'])->name('update');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy']);