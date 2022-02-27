<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::post('/home', 'App\Http\Controllers\HomeController@store');

Route::get('/updateThing', 'App\Http\Controllers\HomeController@updateThing');
Route::post('/updateCuaca', 'App\Http\Controllers\HomeController@updateCuaca');
// Route::get('/updateThing', [HomeController::class, 'updateThing'])->name('updateThing');

Route::get('/user', 'App\Http\Controllers\UserController@create');
Route::post('/user', 'App\Http\Controllers\UserController@store');
Route::get('/user/{user}/edit', 'App\Http\Controllers\UserController@edit');
Route::delete('/user/{user}', 'App\Http\Controllers\UserController@destroy');
Route::put('/user/{user}', 'App\Http\Controllers\UserController@update');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

