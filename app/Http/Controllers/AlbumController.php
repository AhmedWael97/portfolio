<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\User;
use \Illuminate\Support\Facades\URL;
use Image;
class AlbumController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('Dashboard.albums.index')->with('user_albums',Album::get());
    }
    public function create() {
        return view('Dashboard.albums.create')->with([
            'users' => User::get(),
        ]);
    }

    public function store(Request $request) {



        $request->validate([
            'name' => 'required',

        ]);
        $drive  = new \App\Http\Controllers\GoogleDriveController();
        $folder = $drive->createFolder($request->name);
        $newAlbum = new Album($request->all());
        $newAlbum->folder = json_encode( $folder);
        $newAlbum->save();


        return redirect()->route('album-view',$newAlbum->id)->with('success','Your Album Added Succfully');
    }

    public function saveImage(Request $request, $id) {

         $album = Album::where('id',$id)->select('id','folder')->first();
         $folder = json_decode($album->folder);
         $drive  = new \App\Http\Controllers\GoogleDriveController();
         $image = $request->file('file');
        $url = $drive->uploadFileUsingAccessToken($folder, $image);

        $input['file'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(300, 300, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath.'/'.$input['file']);


                $albumImage = new AlbumImage();
                $albumImage->photo = $url;
                $albumImage->album_id = $album->id;
                $albumImage->thumbnail = $input['file'];
                $albumImage->save();
    }

    public function deleteImage($id) {
        $image = AlbumImage::findOrFail($id);
        $image->delete();

        return back()->with('success','Deleted Successfully');
    }

    public function view($id) {
        $album = Album::where('id',$id)->first();
        $images = AlbumImage::where('album_id',$id)->get();
        return view('Dashboard.albums.view')->with([
            'images' => $images,
            'user' => User::where('id', $album->user_id)->first(),
            'album' => $album
            ]);
    }

    public function destroy($id) {
        $album = Album::findOrFail($id);
        $album->delete();
        return redirect()->route('album-index')->with('danger','Your Album Deleted Succfully');
    }

    public function destroy_photo($id) {
        $albumImage = AlbumImage::findOrFail($id);
        $albumImage->delete();
        return redirect()->route('album-index')->with('success','Your Photos deleted Succfully');
    }
    // public function update() {

    // }

}
