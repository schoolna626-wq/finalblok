<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\logincontroller@index');
Route::post('/login', 'App\Http\Controllers\logincontroller@aksilogin');

Route::get('/home', 'App\Http\Controllers\logincontroller@home');
Route::get('/users/export/excel', 'App\Http\Controllers\logincontroller@exportUsersExcel');
Route::get('/users/export/pdf', 'App\Http\Controllers\logincontroller@exportUsersPdf');
Route::get('/logout', 'App\Http\Controllers\logincontroller@logout');

Route::get('/girasya', 'App\Http\Controllers\logincontroller@tampil');
Route::post('/input', 'App\Http\Controllers\logincontroller@zano');

Route::get('/edit/{user}', 'App\Http\Controllers\logincontroller@editview');
Route::put('/edit/{user}', 'App\Http\Controllers\logincontroller@update');
Route::delete('/delete/{user}', 'App\Http\Controllers\logincontroller@delete');

Route::get('/tkry', 'App\Http\Controllers\logincontroller@tkry');
Route::post('/aksi_tkry', 'App\Http\Controllers\logincontroller@aksi_tkry');
Route::get('/karyawan', 'App\Http\Controllers\logincontroller@karyawan');

Route::get('/pelanggan', 'App\Http\Controllers\logincontroller@pelanggan');
Route::get('/tplg', 'App\Http\Controllers\logincontroller@tplg');
Route::post('/aksi_tplg', 'App\Http\Controllers\logincontroller@aksi_tplg');