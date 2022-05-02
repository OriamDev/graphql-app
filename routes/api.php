<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('api.categories.show');
Route::get('categories', [CategoryController::class, 'index'])->name('api.categories.index');
Route::post('categories', [CategoryController::class, 'create'])->name('api.categories.create');
Route::patch('categories/{category}', [CategoryController::class, 'update'])->name('api.categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');

Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('api.products.show');


