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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**
 * route universal
 */
Route::get('/pengadaan/index','PengadaanController@index')->name('pengadaan.index');
Route::get('IT/peminjaman','ItController@index')->name('it.peminjaman');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:admin']], function () {
        /**
         * admin
         */
        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::resource('/users', 'UserController')->except([
            'show'
        ]);
        Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
        Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
        Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
        Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
    });

    Route::group(['middleware' => ['role:IT']], function () {
        /**
         * IT
         */
        Route::get('IT/get_data_aset','ItController@search')->name('it.search');
        Route::get('IT/get_data_aset_perbaikan','ItController@search_perbaikan')->name('it.search_perbaikan');
        Route::post('IT/pengajuan/peminjaman','ItController@pengajuan')->name('it.input.peminjaman');
        Route::get('IT/peminjaman/delete/{id}','ItController@peminjaman_delete')->name('it.peminjaman_delete');
        Route::post('IT/pengajuan/perbaikan','ItController@perbaikan_input')->name('it.input.perbaikan');
        Route::get('IT/pengembalian','ItController@pengembalian_index')->name('it.pengembalian');
        Route::get('IT/pengembalian/aset/{id}','ItController@pengembalian_aset')->name('it.pengembalian_aset');
        Route::post('IT/pengembalian/aset/submit/{id}','ItController@pengembalian_submit')->name('it.pengembalian_submit');
        Route::get('IT/pengembalian/{id}/hapus','ItController@pengembalian_delete')->name('it.pengembalian.delete');
        Route::get('IT/perbaiakan','ItController@perbaikan')->name('it.perbaikan');
        Route::get('IT/perbaiakan/konfirmasi/{id}','ItController@perbaikan_konfirmasi')->name('it.perbaikan_konfirmasi');
        Route::get('IT/perbaiakan/delete/{id}','ItController@perbaikan_delete')->name('it.perbaikan_delete');
        Route::get('IT/monitoring','ItController@monitoring')->name('it.monitoring');

        /**
         * Pengadaan IT
         */
        Route::post('/pengadaan/store','PengadaanController@store')->name('pengadaan.store');
        Route::get('/pengadaan/edit/{id}','PengadaanController@edit')->name('pengadaan.edit');
        Route::post('/pengadaan/update/{id}','PengadaanController@update')->name('pengadaan.update');

        /**
         * data aset
         */
        Route::get('/aset','AsetController@index')->name('aset.index');
        Route::get('/aset/tambah_barang','AsetController@create')->name('aset.create');
        Route::post('/aset/simpan_barang-aset','AsetController@store')->name('aset.store');
        Route::get('/aset/hapus/{id}','AsetController@destroy')->name('aset.destroy');
        Route::get('/aset/edit/{id}','AsetController@edit')->name('aset.edit');
        Route::post('/aset/update/{id}','AsetController@update')->name('aset.update');

        
        /**
         * Laporan
         */
        Route::post('cetak/laporan/peminjaman','LaporanController@peminjaman')->name('laporan.peminjaman');
        Route::post('cetak/laporan/pengembalian','LaporanController@pengembalian')->name('laporan.pengembalian');

    });

    Route::group(['middleware' => ['role:kepala sumber daya']], function () {
        /**
         * kepala sumber daya
         */
        Route::get('/kepala_sumber_daya/konfirmasi/{id}','SumberdayaController@index')->name('kepala_sumber_daya.konfirmasi');
        Route::get('/kepala_sumber_daya/konfirmasi_peminjaman/{id}','SumberdayaController@konfirmasi_peminjaman')->name('kepala_sumber_daya.konfirmasi_peminjaman');
        Route::post('/kepala_sumber_daya/tolak/{id}','SumberdayaController@tolak')->name('kepala_sumber_daya.tolak');
        Route::post('/kepala_sumber_daya/konfirmasi/barang/{id}','SumberdayaController@konfirmasi')->name('kepala_sumber_daya.konfirmasi.barang');
    });

    Route::group(['middleware' => ['role:keuangan']], function () {
        /**
         * keuangan
         */
        Route::get('/keuangan/konfirmasi/{id}','KeuanganController@index')->name('keuangan.konfirmasi');
        Route::post('/keuangan/tolak/{id}','KeuanganController@tolak')->name('keuangan.tolak');
        Route::post('/keuangan/konfirmasi/barang/{id}','KeuanganController@konfirmasi')->name('keuangan.konfirmasi.barang');
    });

});
