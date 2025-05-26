<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

// Di routes/web.php (atau admin.php jika kamu pecah file route)
Route::get('/login/guru', [App\Http\Controllers\Auth\LoginController::class, 'showGuruLoginForm'])->name('login.guru');
Route::get('/login/siswa', [App\Http\Controllers\Auth\LoginController::class, 'showSiswaLoginForm'])->name('login.siswa');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
