<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\BarangkeluarController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('barang', BarangController::class)->middleware('auth');

Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);

Route::get('logout', [LoginController::class,'logout']);
Route::post('logout', [LoginController::class,'logout']);

Route::get('register', [RegisterController::class,'create']);
Route::post('register', [RegisterController::class,'store']);

Route::get('kategori', [KategoriController::class, 'index']);
Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');



Route::resource('barangmasuk', BarangmasukController::class)->middleware('auth');
Route::resource('barangkeluar', BarangkeluarController::class)->middleware('auth');