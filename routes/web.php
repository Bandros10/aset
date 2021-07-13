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

/**
 * Pengadaan
 */
Route::get('/pengadaan/index','PengadaanController@index')->name('pengadaan.index');
Route::post('/pengadaan/store','PengadaanController@store')->name('pengadaan.store');
/**
 * data aset
 */
Route::resource('/aset', 'AsetController');

/**
 * kepala sumber daya
 */
Route::get('/kepala_sumber_daya/konfirmasi/{id}','SumberdayaController@index')->name('kepala_sumber_daya.konfirmasi');
Route::post('/kepala_sumber_daya/konfirmasi/barang/{id}','SumberdayaController@konfirmasi')->name('kepala_sumber_daya.konfirmasi.barang');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
