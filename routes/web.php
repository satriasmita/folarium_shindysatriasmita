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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/pegawais', 'PegawaiController');
Route::get('/pegawai', 'PegawaiController@pegawai');
Route::post('pegawai/delete/{id}', 'PegawaiController@destroy');
Route::resource('/jabatans', 'JabatanController');
Route::get('/jabatan', 'JabatanController@jabatan');
Route::post('jabatans/delete/{id}', 'JabatanController@destroy');

Route::resource('/kontraks', 'KontrakController');
Route::get('/kontrak', 'KontrakController@kontrak');
Route::post('kontraks/delete/{id}', 'KontrakController@destroy');
