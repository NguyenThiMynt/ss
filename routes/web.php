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


//Route::group(['middleware' => 'web'], function () {
//    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showAdminLoginForm']);
//    Route::post('login', ['as' => 'post_login', 'uses' => 'LoginController@adminLogin']);
//    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
//});
Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\UserProfileController@login']);
Route::post('admin/post-login', ['as' => 'admin.post.login', 'uses' => 'Admin\UserProfileController@postLogin']);
Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\UserProfileController@logout']);
Route::group(['prefix' => '/admin', 'middleware'=>'auth-admin'], function () {
    Route::get('calendar/list', ['as' => 'calendar.index', 'uses' => 'Admin\CalendarController@index']);
    Route::get('calender/create', ['as' => 'calendar.create', 'uses' => 'Admin\CalendarController@createCalendar']);

    Route::get('notification/list', ['as' => 'notification.index', 'uses' => 'Admin\NotificationController@showListNotification']);
    Route::get('notification/create', ['as' => 'notification.create', 'uses' => 'Admin\NotificationController@createNotification']);
    Route::post('notification/post-notification', ['as' => 'notification.post.create', 'uses' => 'Admin\NotificationController@postNotification']);
    Route::post('notification/edit-notification/{notification_id}', ['as' => 'notification.edit', 'uses' => 'Admin\NotificationController@createNotification']);

    Route::get('blog/list', ['as' => 'blogs.index', 'uses' => 'Admin\BlogController@index']);
    Route::get('blog/create', ['as' => 'blogs.create', 'uses' => 'Admin\BlogController@createBlog']);

    Route::get('user/list', ['as' => 'user.index', 'uses' => 'Admin\UserProfileController@showListUser']);
    Route::get('user/create', ['as' => 'user.create', 'uses' => 'Admin\UserProfileController@createUser']);
    Route::post('user/post-user', ['as' => 'user.post.create', 'uses' => 'Admin\UserProfileController@registerUser']);
    Route::get('user/edit-user/{user_id}', ['as' => 'user.edit', 'uses' => 'Admin\UserProfileController@createUser']);
    Route::post('user/delete-user', ['as' => 'user.delete', 'uses' => 'Admin\UserProfileController@deleteUser']);
});