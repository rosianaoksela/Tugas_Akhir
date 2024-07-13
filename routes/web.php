<?php

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

Route::get('/','HomeController@index');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('admin/dashboard');
    });
    Route::get('kelas/', 'KelasController@index')->middleware('admin');
    Route::get('kelas/{id}', 'KelasController@show')->middleware('admin');
    Route::get('mahasiswa/', 'MahasiswaController@index')->middleware('admin');
    Route::get('mahasiswa/pdf', 'MahasiswaController@pdf')->middleware('admin');
    Route::get('akun','AuthController@lists')->middleware('admin');
    Route::get('guru','GuruController@index')->middleware('admin');
});

Route::get('/absensi/', 'AbsensiController@index');
Route::get('/absensi/{id}', 'AbsensiController@show');
Route::post('/absensi/','AbsensiController@create');

Route::post('/kelas/', 'KelasController@create');
Route::put('/kelas/', 'KelasController@update');
Route::delete('/kelas/delete/{id}', 'KelasController@delete');

Route::get('/mahasiswa/{id}', 'MahasiswaController@show');
Route::post('/mahasiswa/', 'MahasiswaController@create');
Route::put('/mahasiswa/', 'MahasiswaController@update');
Route::delete('/mahasiswa/delete/{id}', 'MahasiswaController@delete');
Route::post('/mahasiswa/search/', 'MahasiswaController@search');

Route::get('/guru/', 'GuruController@index');
Route::get('/guru/{id}', 'GuruController@show');
Route::post('/guru/','GuruController@create');
Route::put('/guru/', 'GuruController@update');
Route::delete('/guru/delete/{id}', 'GuruController@delete');
Route::post('/guru/search/', 'GuruController@search');

Route::get('/admin/rekap/','RekapController@index');
Route::get('/admin/rekap/{table}','RekapController@show');
Route::post('/rekap/pribadipdf/','RekapController@pdf');
Route::get('/rekap/kelas/{id}','RekapController@rekap');
Route::post('/rekap/','RekapController@hitung');

Route::post('/mahasiswakelas/', 'MahasiswaKelasController@create')->middleware('admin');
Route::get('/mahasiswakelas/{id}', 'MahasiswaKelasController@add')->middleware('admin');
Route::delete('/mahasiswakelas/delete/{id}', 'MahasiswaKelasController@delete')->middleware('admin');


Route::get('register','AuthController@daftar');
Route::post('register','AuthController@prosesDaftar');

Route::post('/akun/','AuthController@create');
Route::put('/akun/', 'AuthController@update');
Route::delete('akun/delete/{id}','AuthController@delete');

Route::prefix('u')->group(function(){
    Route::get('dashboard','UserController@index')->middleware('logged');
});

Route::get('logout','AuthController@logout');
Route::get('admin', 'AuthController@showForm');
Route::get('dosen', 'AuthController@showForm');
Route::get('login', 'AuthController@showForm');
Route::post('login', 'AuthController@login');

Route::get('panduan',function(){
    return view('panduan/panduan');
});