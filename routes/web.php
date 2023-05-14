<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
    return view('website.pages.welcome');
});

Route::get('/web-login',function() {
    return view('website.pages.login');
});

Route::post('/login-post',function(Request $request) {
    if(! $request->has('email') || ! $request->has('password')) {
        return back()->with('errors','Please Fill all inputs below');
    }

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('/profile');
    } else {
        return back()->with('errors','Email or password is incorrect');
    }
});

Route::get('/profile',function() {
    if(! Auth::check()) {
        return redirect('/');
    } else {
        return view('website.pages.profile');
    }
});

Route::get('/logout',function() {
    if(Auth::check()) {
        Auth::logout();
    }
    return redirect('/');
});

 Auth::routes();

Route::get('/dashboard-login',function() {
    return view('auth.login');
});

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
Route::get('/glogin','\App\Http\Controllers\GoogleDriveController@googleLogin')->name('glogin');
Route::post('/upload-file','\App\Http\Controllers\GoogleDriveController@uploadFileUsingAccessToken');


Route::get('/download-album/{id}',function($id) {
    $album = \App\Models\AlbumImage::where('album_id',$id)->get();
    foreach($album as $image) {
        $filename = rand(1,111111111).'.jpg';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($image->photo, $tempImage);

        return response()->download($tempImage, $filename);
    }
    return back();
});

Route::get('/getAlbumImages/{id}',function($id) {
    return \App\Models\AlbumImage::where('album_id',$id)->select('id')->get()->pluck('id');
});

Route::get('/download-image/{id}',function($id) {

   $image = \App\Models\AlbumImage::findOrFail($id);
   return $image->photo;
});
