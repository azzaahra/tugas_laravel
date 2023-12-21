<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StaffController;
use App\Models\Staff;
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

Route::get('/', function () {
    return view('auth.login');
});


// groub route untuk admin 

Route::prefix('admin')->group(function () {
    //route untuk auth
    Route::group(['middleware' => 'auth'], function(){
        //buat route untuk dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        // untuk membuat route Barang
        Route::resource('/menu', MenuController::class, ['as'=>'admin']);
        // untuk membuat route Supplier
        Route::resource('/customer', CustomerController::class, ['as'=>'admin']);
        // untuk membuat route transaksi
        Route::resource('/order', OrderController::class, ['as'=>'admin']);
        Route::resource('/staff', StaffController::class, ['as'=>'admin']);
    });
});