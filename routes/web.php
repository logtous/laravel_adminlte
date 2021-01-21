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

/**
 *  Default
 */
Route::get('/', function () {
    return redirect('login');
});

/**
 *  Login
 */
Auth::routes(['register' => false]);

/**
 *  Language Swithcher
 */
Route::get('setlocale/{locale}', function ($lang) {
       \Session::put('locale', $lang);
       return redirect()->back();
});

/**
 *  Menu Search
 */
Route::get('/search', 'HomeController@search')->name('search');

/**
 *  Dashboard
 */
Route::get('/home', 'HomeController@index')->name('home');

/**
 *  User Management
 */
Route::resource('user', 'UserController');
Route::get('user/{id}/role', 'UserController@role')->name('user.role');
Route::put('user/{id}/assignRole', 'UserController@assignRole')->name('user.assignRole');
Route::get('user/{id}/permission', 'UserController@permission')->name('user.permission');
Route::put('user/{id}/assignPermission', 'UserController@assignPermission')->name('user.assignPermission');

/**
 *  Role Management
 */
Route::resource('role', 'RoleController');
Route::get('role/{id}/permission', 'RoleController@permission')->name('role.permission');
Route::put('role/{id}/assignPermission', 'RoleController@assignPermission')->name('role.assignPermission');

/**
 *  Permission Management
 */
Route::resource('permission', 'PermissionController');

/**
 *  Login Log
 */
Route::resource('login_log', 'LoginLogController', ['except'=> ['store', 'show', 'update', 'create', 'edit']]);


/**
 *  Operate Log
 */
Route::resource('operate_log', 'OperateLogController', ['except'=> ['store', 'show', 'update', 'create', 'edit']]);
