<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/get-albums-images/{id}' , function($id) {
     $album_images= \App\Models\AlbumImage::where('album_id',$id)->with('album')->get();
        $images = [];
        foreach($album_images as $image) {
            $image = '<img src="'. $image->photo .'" style="width: auto; height:200px; margin-left:20px; margin-bottom:20px" />';

            array_push($images,$image);
        }

        return response()->json( $images );
});
