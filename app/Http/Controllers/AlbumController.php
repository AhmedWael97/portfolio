<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\User;
use \Illuminate\Support\Facades\URL;
class AlbumController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('dashboard.albums.index')->with('user_albums',Album::get());
    }
    public function create() {
        return view('dashboard.albums.create')->with([
            'users' => User::get(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
          
        ]);
        $newAlbum = new Album($request->all());

        $newAlbum->save();

        if($request->has('images') && count($request->images) >= 1) {
            foreach ($request->file('images') as $imagefile) {
                $albumImage = new AlbumImage();
                $imageName = time().'-'.$imagefile->getClientOriginalName();
                $imagefile->move(public_path('albums'), $imageName);
                $albumImage->photo = URL::asset('/albums').'/'.$imageName;
                $albumImage->album_id = $newAlbum->id;
                $albumImage->base_64 = 'data:image/' . $imagefile->getClientOriginalExtension() . ';base64,' . base64_encode(URL::asset('/albums').'/'.$imageName);
                $albumImage->save();
            }
        }

        return redirect()->route('album-index')->with('success','Your Album Added Succfully');
    }

    public function view($id,$user_id) {
        $images = AlbumImage::where('album_id',$id)->get();
        return view('dashboard.albums.view')->with([ 
            'images' => $images,
            'user' => User::where('id',$user_id)->first(),
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
