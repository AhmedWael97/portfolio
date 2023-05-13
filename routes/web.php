<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login',function() {
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
