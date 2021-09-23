<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'AuthController@apilogin');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {
	Route::get('/profil', 'PenggunaController@profil');
	Route::get('/pembayaran', 'PembayaranController@apiPembayaran');
	Route::get('/pembayaran/{id}', 'PembayaranController@apiDetailPembayaran');

	Route::get('/berita', 'BeritaController@apiBerita');
	Route::get('/berita/{id}', 'BeritaController@apiDetailBerita');

	Route::get('/santri', 'SantriController@apiSantri');
	Route::get('/santri/{id}', 'SantriController@apiDetailSantri');
	Route::get('/santri/{id}/hafalan', 'SantriController@apiHafalanSantri');
	Route::get('/santri/{id}/hafalan-baru', 'SantriController@apiHafalanBaruSantri');
	Route::get('/santri/{id}/kesalahan', 'SantriController@apiKesalahanSantri');
});