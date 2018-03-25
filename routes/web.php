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

Route::get('send-message', 'RedisController@index');
Route::post('send-message', 'RedisController@sendMessage');
Route::get('mail', 'RedisController@sendMail');

Route::get('/', function() {
    return view('mails.welcome');
});
