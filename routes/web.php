<?php

Route::get('send-message', 'RedisController@index');
Route::post('send-message', 'RedisController@sendMessage');
Route::get('mail', 'RedisController@sendMail');

Route::get('/', function() {
    return view('mails.welcome');
});
