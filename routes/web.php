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

Route::get('/', function () {return view('welcome');});
Route::get('/index', function () {return view('index');});
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('post/lists', ['as' => 'post.lists', 'uses' => 'TaskController@lists']);
// Route::any('post/validate', ['as' => 'post.validate', 'uses' => 'TaskController@formValidation']);
// Route::any('post/{post}/{doc_id}/download', ['as' => 'post.download', 'uses' => 'TaskController@download']);
// Route::any('post/upload', ['as' => 'post.upload', 'uses' => 'TaskController@upload']);
Route::resource('post', 'PostController')->only([
    'index', 'create', 'store', 'edit', 'update', 'show'
]);



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
Route::get('/index', function () {return view('index');})->name('index');