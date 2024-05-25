<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list/absen','AbsenController@show')->name('absen');
Route::get('/absen/hadir','AbsenController@hadir')->name('absen.hadir');
Route::get('/absen/vip','AbsenController@vip')->name('absen.vip');
Route::post('/absen/hadir/{id}','AbsenController@store')->name('absen.store');
