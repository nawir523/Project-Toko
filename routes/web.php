<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoeController; 
use App\Http\Controllers\KatalogController;// Pastikan nama controller ini sesuai dengan kasus sensitif
use App\Http\Controllers\TransaksiController;
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
    return view('home');
})->name('home');

Route::get('/about', [UserController::class, 'about'])->name('about');

Route::group(['middleware' => 'web'], function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');

    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

// Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
   
    Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
});

// Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');

    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');

    Route::get('/admin/shoes', [ShoeController::class, 'index'])->name('admin/shoes');
    Route::get('/admin/shoes/create', [ShoeController::class, 'create'])->name('admin/shoes/create'); // Perbaikan di sini
    Route::post('/admin/shoes/store', [ShoeController::class, 'store'])->name('admin/shoes/store');
    Route::get('/admin/shoes/show/{id}', [ShoeController::class, 'show'])->name('admin/shoes/show');
    Route::get('/admin/shoes/edit/{id}', [ShoeController::class, 'edit'])->name('admin/shoes/edit');
    Route::put('/admin/shoes/update/{id}', [ShoeController::class, 'update'])->name('admin/shoes/update');
    Route::delete('/admin/shoes/destroy/{id}', [ShoeController::class, 'destroy'])->name('admin/shoes/destroy');

    
    Route::get('admin/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::get('admin/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');


    
    Route::get('admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('admin/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('admin/transaksi/downloadExcel', [TransaksiController::class, 'downloadExcel'])->name('transaksi.downloadExcel');

});



