<?php

use Illuminate\Support\Facades\Route;

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

// 無須驗證
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('register', 'Auth\LoginController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Route::get('/index', function () {return view('index');})->name('index');
Route::get('/', 'HomeController@home');

// 需經過驗證
Route::group(['middleware' => 'auth'], function () {
    Route::resource('home', 'HomeController')->only([
        'index', 'show',
    ]);
    
    Route::post('post/data', ['as' => 'post.data', 'uses' => 'PostController@data']);
    Route::resource('post', 'PostController')->only([
        'store', 'edit', 'update', 'show'
    ]);
    
    Route::post('category/data', ['as' => 'category.data', 'uses' => 'CategoryController@data']);
    Route::resource('category', 'CategoryController')->only([
        'store', 'edit', 'update', 'show'
    ]);
    
});

