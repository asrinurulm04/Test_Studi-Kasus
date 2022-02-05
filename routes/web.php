<?php

Route::get('/', function () {
    return redirect('/signin');
});

Route::get('home','HomeController@home')->name('home');

/** Auth */

Route::get('daftar', 'Auth\RegistrationController@create');
Route::post('add', [
    'uses'=> 'Auth\RegistrationController@registrationPost',
    'as' => 'add']);
 
Route::get('signin', 'Auth\LoginController@getLogin')->name('signin');
Route::post('postLogin', 'Auth\LoginController@postLogin')->name('postLogin');
Route::get('signout', function(){
    Auth::logout();
    return redirect('/');
})->name('signout');
// Transaksi
route::get('pesan/{kode}','PesanController@index')->name('pesan');
Route::get('stok/{id}','PesanController@stok')->name('stok');
Route::post('addObat','PesanController@addObat')->name('addObat');
Route::get('destroy/{id}','PesanController@destroy')->name('destroy');
Route::get('batalkanOrder/{id}','PesanController@batalkanOrder')->name('batalkanOrder');
Route::get('selesaikanOrder/{kode}','PesanController@selesaikanOrder')->name('selesaikanOrder');
// Dasboard
Route::get('dasboard','DasboardController@dasboard')->name('dasboard');
// Database Obat
Route::get('obat','ObatController@index')->name('obat');
Route::post('editStok/{id}','ObatController@editStok')->name('editStok');
// Report
Route::get('report/{kode}','ReportController@report')->name('report');
Route::get('laporan-pdf/{kode}','ReportController@generatePDF')->name('laporan-pdf');
