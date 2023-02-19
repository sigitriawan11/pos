<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [IndexController::class, 'index'])->middleware('auth')->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/transaction/store', [IndexController::class, 'createTransaction']);
    Route::get('/transaction/success/{transaction:code_trx}', [IndexController::class, 'transactionSuccess']);
    Route::get('/transactions', [IndexController::class, 'transactions'])->name('transactions');
});

Route::middleware(['auth', 'admin'])->group(function (){
    Route::resource('/cashiers', CashierController::class)->name('index', 'cashiers');
    Route::resource('/categories', CategoryController::class)->name('index', 'categories');
    Route::resource('/products', ProductController::class)->name('index', 'products');
    Route::resource('/suppliers', SupplierController::class)->name('index', 'suppliers');
    Route::resource('/purchases', PurchaseController::class)->name('index', 'purchases');
    Route::resource('/salaries', SalaryController::class)->name('index', 'salaries');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
