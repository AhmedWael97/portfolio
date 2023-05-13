<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin/dashboard')->group(function($router){

   Route::get('/user-index','App\Http\Controllers\usersController@index')->name('user-index');
   Route::get('/user-create','App\Http\Controllers\usersController@create')->name('user-create');
   Route::post('/user-store','App\Http\Controllers\usersController@store')->name('user-store');
   Route::get('/user-edit/{id}','App\Http\Controllers\usersController@edit')->name('user-edit');
   Route::post('/user-update','App\Http\Controllers\usersController@update')->name('user-update');
   Route::get('/user-delete/{id}','App\Http\Controllers\usersController@destroy')->name('user-delete');

   Route::get('/album-index','App\Http\Controllers\AlbumController@index')->name('album-index');
   Route::get('/album-create','App\Http\Controllers\AlbumController@create')->name('album-create');
   Route::post('/album-store','App\Http\Controllers\AlbumController@store')->name('album-store');
   Route::get('/album-view/{id}/{user_id}','App\Http\Controllers\AlbumController@view')->name('album-view');
//    Route::post('/album-update','App\Http\Controllers\AlbumController@update')->name('album-update');
   Route::get('/album-delete/{id}','App\Http\Controllers\AlbumController@destroy')->name('album-delete');
  
});


