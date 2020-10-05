<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('home');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin']], function(){
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/edit/{siswa}', 'SiswaController@edit');
    Route::patch('/siswa/update/{siswa}', 'SiswaController@update');
    Route::get('/siswa/delete/{siswa}', 'SiswaController@destroy');
    Route::get('/siswa/profile/{siswa}', 'SiswaController@profile');
    Route::post('/siswa/addnilai/{siswa}', 'SiswaController@nilai');
    Route::get('/siswa/deletenilai/{idsiswa}/{idmapel}', 'SiswaController@deletenilai');
    Route::get('/siswa/exportexcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportpdf', 'SiswaController@exportPdf');
    Route::get('/guru/profile/{guru}', 'GuruController@profile');
});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function(){
    Route::get('/dashboard', 'DashboardController@index');
});
