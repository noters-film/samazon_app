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

Route::get('/', 'WebController@index');

Route::get('users/carts', 'CartController@index')->name('carts.index');

Route::post('users/carts', 'CartController@store')->name('carts.store');

Route::get('users/mypage', 'UserController@mypage')->name('mypage');
Route::get('users/mypage/edit', 'UserController@edit')->name('mypage.edit');
Route::get('users/mypage/address/edit', 'UserController@edit_address')->name('mypage.edit_address');
Route::put('users/mypage', 'UserController@update')->name('mypage.update');
Route::get('users/mypage/favorite', 'UserController@favorite')->name('mypage.favorite');
Route::get('users/mypage/password/edit', 'UserController@edit_password')->name('mypage.edit_password');
Route::put('users/mypage/password', 'UserController@update_password')->name('mypage.update_password');

Route::post('products/{product}/reviews', 'ReviewController@store');

Route::post('products/{product}/favorite', 'ProductController@favorite')->name('products.favorite');
Route::resource('products', 'ProductController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admins');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
 Route::get('login', 'Dashboard\Auth\LoginController@showLoginForm')->name('login');
 Route::post('login', 'Dashboard\Auth\LoginController@login')->name('login');
});

if (env('APP_ENV') === 'production') {
 URL::forceScheme('https');
}