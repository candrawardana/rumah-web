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

Route::get('/', 'DashboardController@welcome')->name('welcome');
Route::get('policy', 'DashboardController@policy')->name('policy');


Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');

Route::get('/kegiatan', 'KegiatanController@webKegiatan');
Route::get('/kegiatan/{id}', 'KegiatanController@webDetailKegiatan');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/pengumuman', 'PengumumanController@webPengumuman');


    Route::get('home', 'DashboardController@home')->name('home');
    Route::get('user', 'PenggunaController@user')->name('user');
    Route::post('user/save', 'PenggunaController@save');
    Route::post('user/delete', 'PenggunaController@delete');
    // Route::get('nodin/{status?}', 'NodinController@nodin')->name('nodin');
    // Route::get('lihat-nodin/{id}/{file}', 'NodinController@lihat');
    // Route::get('lihat-pendukung/{id}/{file}', 'NodinController@lihat2');
    // Route::get('hapus-pendukung/{id}/{file}', 'NodinController@hp');
    // Route::post('save-nodin', 'NodinController@save');
    // Route::get('rekap/{status?}', 'NodinController@rekap')->name('nodin');
    // Route::get('rekap-export/{status?}', 'NodinController@export');
    Route::get('logout', 'AuthController@logout')->name('logout'); 

    Route::get('pp/{id}/{file}', 'PenggunaController@lihat');
    Route::post('ganti-pp', 'PenggunaController@ppupload');
    Route::get('hapus-pp', 'PenggunaController@pphapus');

});