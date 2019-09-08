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

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth', 'as' => 'dashboard.'], function () {
    Route::get('/', 'RawatInapController@charts')->name('index');

    Route::resource('kamar', 'KamarController');
    Route::resource('dokter', 'DokterController');
    Route::resource('diagnosa', 'DiagnoseController');
    Route::get('rawatinap/selesai/{no_rm}','RawatInapController@selesai')->name('rawatinap.selesai');
    Route::get('charts', 'RawatInapController@charts');
    Route::resource('rawatinap', 'RawatInapController');
    Route::post('reports/filter','ReportController@filter');
    Route::get('reports/stream','ReportController@stream');
    Route::get('reports/download','ReportController@download');
    Route::resource('reports','ReportController');
});



Auth::routes();
