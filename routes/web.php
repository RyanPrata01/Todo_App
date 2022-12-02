<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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
Route::middleware('isGuest')->group(function() {
    Route::get('/', [TodoController::class, 'index']);
    Route::get('/login', [TodoController::class, 'login']);
    Route::get('/register', [TodoController::class, 'register'])->name('register-page');
    Route::post('/register/input', [TodoController::class, 'registerAccount'])->name('register.input');
    Route::post('/login/auth', [TodoController::class, 'auth'])->name('login.auth');
});

Route::get('/logout', [TodoController::class, 'logout'])->name('logout');


Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function(){
    Route::get('/', [TodoController::class, 'todo'])->name('index');
    Route::get('/create', [TodoController::class, 'create'])->name('create.input');
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::post('/complete', [TodoController::class, 'complated'])->name('complated');

    // Route path yang menggunakan { } berarti dia berperan sebagai parameter route
    // Parameter ini bentuk nya data dinamis (data yang dikirim route untuk di ambil parameter function controller terkait) 
    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
    // method route untuk ubah data di db itu patch/put
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    // method route untuk hapus data di db itu delete
    //Mengabah pakai path dinamis {id}, karena untuk mencari spesifikasi data yang harus di hapus
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');
    Route::patch('/complated/{id}', [TodoController::class, 'updateComplated'])->name('update-complated');
});





