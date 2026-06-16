<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KuisController;
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

// Halaman Login & Register
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'prosesLogin']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'prosesRegister']);
});

// Halaman Setelah Login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Fitur CRUD Materi & Kuis
    Route::resource('materi', MateriController::class);
    Route::resource('kuis', KuisController::class);
    Route::get('/kuis/{id}/mulai', [KuisController::class, 'mulai'])->name('kuis.mulai');
    Route::post('/kuis/{id}/submit', [KuisController::class, 'submit'])->name('kuis.submit');
    Route::get('/kuis/{id}/soal/create', [KuisController::class, 'createSoal'])->name('soal.create');
    Route::post('/kuis/{id}/soal', [KuisController::class, 'storeSoal'])->name('soal.store');
});
