<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

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
    $previous_work = App\Models\previous_work::take(8)->get();
    $latest_work = App\Models\latest_project::take(8)->get();
    return view('website.pages.welcome')->with(
        ['previous_works' => $previous_work , 'latest_works' => $latest_work]
    );
});


Route::get('make-me-read/{id}',function($id){
    $notif = Auth::user()->notifications()->where('id', $id)->first();
    $notif->read_at = now();
    $notif->save();

    $zip = $notif->data['path'];

    if(File::exists( public_path($notif->data['path']) )) {
        File::delete(public_path($notif->data['path']));
    }
    
    $notif->delete();
    return [
        "data" => view('website.pages.notifications')->render(),
    ];
});


Route::get('new_notification', function() {
    if(Auth::user()->notifications()->where('read_at', null)->count() >= 1){
        return [
            "found" => 1,
            "data" => view('website.pages.notifications')->render(),
        ];
    } else {
        return [
            "found" => 0,
            "data" => []
        ];
    }
});

Route::get('/web-login',function() {
    if(Auth::check()) {
        return redirect('/profile');
    }
    return view('website.pages.login');
});

Route::post('/login-post',function(Request $request) {
    if(! $request->has('phone') || ! $request->has('password')) {
        return back()->with('errors','Please Fill all inputs below');
    }

    $user = User::where('phone',$request->phone)->first();
    if($user == null) {
        return back()->with('errors','Phone Number doesnot exists');
    }

    if(Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
        return redirect('/profile');
    } else {
        return back()->with('errors','Phone or password is incorrect');
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
    if(Auth::check()) {
        return redirect()->route('home');
    }
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
   Route::get('/album-view/{id}','App\Http\Controllers\AlbumController@view')->name('album-view');

   Route::post('/upload-image/{album_id}','App\Http\Controllers\AlbumController@saveImage')->name('upload-images');
   Route::post('/upload/images','App\Http\Controllers\AlbumController@saveImages')->name('upload-image-using-drive');
   Route::get('/delete-image/{image_id}','App\Http\Controllers\AlbumController@deleteImage')->name('delete-image');
//    Route::post('/album-update','App\Http\Controllers\AlbumController@update')->name('album-update');
   Route::get('/album-delete/{id}','App\Http\Controllers\AlbumController@destroy')->name('album-delete');

   //Muhamed fawzy 14-5-2023
   Route::get('/latest-project-images' , 'App\Http\Controllers\LatestProjectController@index')->name('latest-project-images');
   Route::post('/save-latest-images' ,'App\Http\Controllers\LatestProjectController@store')->name('save-latest-image');
   Route::get('/delete-latest-image/{id}' ,'App\Http\Controllers\LatestProjectController@delete')->name('delete-latest-project');


   Route::get('/clients-section-images' , 'App\Http\Controllers\ClientsController@index')->name('clients-section-images');
   Route::post('/save-clients-images' ,'App\Http\Controllers\ClientsController@store')->name('save-clients-image');
   Route::get('/delete-clients-image/{id}' ,'App\Http\Controllers\ClientsController@delete')->name('delete-clients-images');

   Route::get('/previous-work-images' , 'App\Http\Controllers\PreviousWorkController@index')->name('previous-work-images');
   Route::post('/save-previous-work' ,'App\Http\Controllers\PreviousWorkController@store')->name('save-previous-work');
   Route::get('/delete-previous-work/{id}' ,'App\Http\Controllers\PreviousWorkController@delete')->name('delete-previous-work');
});
Route::get('/glogin','\App\Http\Controllers\GoogleDriveController@googleLogin')->name('glogin');
Route::post('/upload-file','\App\Http\Controllers\GoogleDriveController@uploadFileUsingAccessToken');


Route::get('/getZipForAlbum/{id}','\App\Http\Controllers\GoogleDriveController@downloadFileUsingAccessToken')->name('zip');

// Route::get('/getZipForAlbum/{id}',function($id) {
//     if(! Auth::check()) {
//         return response(404);
//     }
//     $album = \App\Models\Album::where('id',$id)->where('user_id',auth()->user()->id)->first();
//     if($album == null) {
//         return response(404);
//     }

//     $zip = new ZipArchive();
//     $zipFileName = $album->name.'.zip';
//     $zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
//     foreach ($album->images as $image) {

//         $contents = file_get_contents($image->photo);

//         $zip->addFromString(rand(1,100).'.jpeg', $contents);



//     }
//     $zip->close();
//     return response()->download($zipFileName)->deleteFileAfterSend();
// })->name('zip');


Route::get("fixing/images",function(){
   $images = \App\Models\AlbumImage::where('id','>',5771)->get(); 
   foreach($images as $image) {
       $split = explode("=",$image->photo);
       if(count($split) == 2) {
           $image->photo = "https://lh3.googleusercontent.com/d/".$split[1];
           $image->save();
       }
   }
});

Route::get('/download-image/{id}',function($id) {
    if(! Auth::check()) {
        return response(404);
    }
    $image = \App\Models\AlbumImage::findOrFail($id);
    if($image == null) {
        return response(404);
    }
    $album = \App\Models\Album::where('id',$image->album_id)->where('user_id',auth()->user()->id)->first();
    if($album == null) {
        return response(404);
    }
   $image = \App\Models\AlbumImage::findOrFail($id);
    //return $image->photo;
    $file = file_get_contents($image->photo);

    $headers = [
        'Content-Type' => 'image/jpeg',
        'Content-Disposition' => 'attachment; filename=image.jpg',
    ];
    return response($file, 200, $headers);
})->name('download');

Route::get('/get-albums-images/{id}' , '\App\Http\Controllers\HomeController@fetch_albums_images');


