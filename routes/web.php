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

Route::get('/', 'DashboardController@home');
Route::get('home', 'DashboardController@home')->name('home');
Route::get('policy', 'DashboardController@policy')->name('policy');

Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('pp/{id}/{file}', 'PenggunaController@lihat');

Route::get('/kegiatan', 'KegiatanController@webKegiatan');
Route::get('/kegiatan/{id}', 'KegiatanController@webDetailKegiatan');

Route::get('/berita', 'BeritaController@webBerita');
Route::get('/berita/{id}', 'BeritaController@webDetailBerita');
Route::get('/berita/{id}/{thumbnail}', 'BeritaController@thumbnail');

Route::get('/gallery/{file}', 'DashboardController@gallery');
Route::get('/foto/{file}/{file2?}', 'SantriController@foto');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/notifikasi', 'DashboardController@notifikasi');

    Route::get('/hapus-gallery/{nomor}', 'DashboardController@galleryHapus');
    Route::post('/tambah-gallery', 'DashboardController@galleryTambah');

    Route::get('/pengumuman/{id?}', 'PengumumanController@webPengumuman');
    Route::post('/tambah-pengumuman', 'PengumumanController@tambahPengumuman');
    Route::get('/hapus-pengumuman/{id}', 'PengumumanController@hapusPengumuman');

    Route::post('/tambah-kegiatan', 'KegiatanController@tambahKegiatan');
    Route::get('/hapus-kegiatan/{id}', 'KegiatanController@hapusKegiatan');

    Route::post('/tambah-berita', 'BeritaController@tambahBerita');
    Route::get('/hapus-berita/{id}', 'BeritaController@hapusBerita'); 

    Route::get('/santri', 'SantriController@webSantri');
    Route::get('/santri/{id}', 'SantriController@webDetailSantri');
    Route::get('/santri/{id}/kesalahan', 'SantriController@webKesalahanSantri');
    Route::get('/tambah-santri', 'SantriController@tambahSantri');
    Route::post('/tambah-santri', 'SantriController@tambahSantriProses');
    Route::get('/santri/{id}/hapus', 'SantriController@hapusSantri');
    Route::post('/santri/{id}/hapus', 'SantriController@hapusSantriProses');
    Route::post('/tambah-kesalahan', 'SantriController@tambahKesalahan');
    Route::get('/hapus-kesalahan/{id}', 'SantriController@hapusKesalahan');
    Route::get('/santri/{id}/hafalan-baru', 'SantriController@webHafalanBaruSantri');
    Route::post('/tambah-hafalan-baru', 'SantriController@tambahHafalanBaru');
    Route::get('/hapus-hafalan-baru/{id}', 'SantriController@hapusHafalanBaru');
    Route::get('/santri/{id}/hafalan', 'SantriController@webHafalanSantri');
    Route::post('/tambah-hafalan', 'SantriController@tambahHafalan');
    Route::get('/hapus-hafalan/{id}', 'SantriController@hapusHafalan');
    Route::get('/santri/{id}/tabungan', 'SantriController@webTabunganSantri');
    Route::post('/tambah-tabungan', 'SantriController@tambahTabungan');
    Route::get('/hapus-tabungan/{id}', 'SantriController@hapusTabungan');
    Route::post('/hapus-tabungan/{id}', 'SantriController@hapusTabunganProses');
    Route::get('/santri/{id}/uang-syariah', 'SantriController@webUangSyariahSantri');
    Route::post('/tambah-uang-syariah', 'SantriController@tambahUangSyariah');
    Route::get('/hapus-uang-syariah/{id}', 'SantriController@hapusUangSyariah');
    Route::get('/santri/{id}/wali', 'SantriController@webWaliSantri');
    Route::get('/santri/{id}/edit', 'SantriController@editSantri');


    Route::get('/pembelian', 'PembayaranController@pembelian');
    Route::get('/pembayaran', 'PembayaranController@webPembayaran');
    Route::get('/bagi-hasil', 'PembayaranController@bagiHasil');

    Route::get('/potongan-tabungan', 'SantriController@potonganTabungan');
    Route::post('/potongan-tabungan', 'SantriController@potonganTabunganProses');

    Route::get('pengguna/{jenis?}', 'PenggunaController@user');
    Route::get('edit-pengguna/{id?}', 'PenggunaController@edit');
    Route::post('tambah-pengguna', 'PenggunaController@save');
    Route::get('hapus-pengguna/{id}', 'PenggunaController@delete');
    Route::get('profil/{id?}', 'PenggunaController@webprofil');
    // Route::get('nodin/{status?}', 'NodinController@nodin')->name('nodin');
    // Route::get('lihat-nodin/{id}/{file}', 'NodinController@lihat');
    // Route::get('lihat-pendukung/{id}/{file}', 'NodinController@lihat2');
    // Route::get('hapus-pendukung/{id}/{file}', 'NodinController@hp');
    // Route::post('save-nodin', 'NodinController@save');
    // Route::get('rekap/{status?}', 'NodinController@rekap')->name('nodin');
    // Route::get('rekap-export/{status?}', 'NodinController@export');
    Route::get('logout', 'AuthController@logout')->name('logout'); 
    Route::post('ganti-pp', 'PenggunaController@ppupload');
    Route::get('hapus-pp', 'PenggunaController@pphapus');

    Route::get('laporan/uang-syariah', 'LaporanController@uangSyariah');
    Route::post('laporan/uang-syariah', 'LaporanController@uangSyariahCetak');
    Route::get('laporan/tabungan', 'LaporanController@tabungan');
    Route::post('laporan/tabungan', 'LaporanController@tabunganCetak');
    Route::get('laporan/hafalan', 'LaporanController@hafalan');
    Route::post('laporan/hafalan', 'LaporanController@hafalanCetak');
    Route::get('laporan/hafalan-baru', 'LaporanController@hafalanBaru');
    Route::post('laporan/hafalan-baru', 'LaporanController@hafalanBaruCetak');

    Route::get('migrasi/tabungan', 'MigrasiDataController@tabungan');
    Route::get('migrasi/hafalan', 'MigrasiDataController@hafalan');
    Route::get('migrasi/hafalan-baru', 'MigrasiDataController@hafalanBaru');
    Route::get('migrasi/kesalahan', 'MigrasiDataController@kesalahan');
    Route::get('migrasi/uang-syariah', 'MigrasiDataController@uangSyariah');
    Route::get('migrasi/pengumuman', 'MigrasiDataController@pengumuman');
    Route::get('migrasi/kegiatan', 'MigrasiDataController@kegiatan');

});