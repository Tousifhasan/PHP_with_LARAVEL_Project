<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return view('welcome');
});
Route::get('/admin', function(){
    return view('backend.layouts.master');
});
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.list');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
// GET	/photos/{photo}	show	photos.show
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
// GET	/photos/{photo}/edit	edit	photos.edit
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// PUT/PATCH	/photos/{photo}	update	photos.update
Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
// DELETE	/photos/{photo}	destroy	photos.destroy
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Route for Product
Route::get('/products', [ProductController::class, 'index'])->name('products.list');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/trash-products', [ProductController::class, 'trash'])->name('products.trashed');
Route::get('/trash-products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/trash-products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');

// For PDF
Route::get('/category-pdf', [CategoryController::class, 'categoryPdf'])->name('categories.pdf');
Route::get('/category-excel', [CategoryController::class, 'export'])->name('categories.excel');
