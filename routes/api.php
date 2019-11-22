<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => 'api'], function () {
    Route::post('/login',['as'=>'api.v1.login','uses'=> 'Api\v1\AuthController@login']);
    Route::post('/signup',['as'=>'api.v1.signup','uses'=> 'Api\v1\AuthController@signup']);
});

Route::group(['prefix' => 'v1', 'middleware' => ['api', 'jwt.auth']], function () {

    Route::post('/register-fcm-token',[
        'as'=>'api.v1.register-fcm-token',
        'uses'=> 'Api\v1\PushNotificationController@registerToken'])->middleware('user-session');
});


