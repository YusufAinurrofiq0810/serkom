<?php

use App\Http\Controllers\Mahasiswa;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you define all of your web routes. They are loaded
| after the routes available in your API routes file.
|
*/

Route::get('/', [Mahasiswa::class, 'index']);

//home
Route::get('/home', [Mahasiswa::class, 'home']);
Route::get('/pencarian', [Mahasiswa::class, 'pencarian']);

//admin
Route::get('admin', [Mahasiswa::class,'admin']);
Route::post('admin/tambah-mahasiswa', [Mahasiswa::class, 'tambahMahasiswa']);
Route::get('admin/hapus-mahasiswa{id}', [Mahasiswa::class, 'hapusMahasiswa']);
Route::put('/admin/edit-mahasiswa/{id}', [Mahasiswa::class, 'editMahasiswa']);


