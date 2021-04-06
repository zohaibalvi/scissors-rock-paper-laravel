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


Auth::routes();

Route::get('/', 'RpsController@mainScreen')->name('home.mainScreen');
Route::get('/start', 'RpsController@index')->name('home.start');
Route::post('/rps', 'RpsController@rps')->name('home.rps');
Route::get('/guest', 'RpsController@playAsAGuest')->name('home.playAsAGuest');
Route::post('/rps/savepoints', 'RpsController@savePointRecords')->name('home.savePoints');
