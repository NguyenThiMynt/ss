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
    return view('welcome');
});


Route::group(['middleware' => 'web'], function () {
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showAdminLoginForm']);
    Route::post('login', ['as' => 'post_login', 'uses' => 'LoginController@adminLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
});

