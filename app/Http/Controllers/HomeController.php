<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;
use App\Models\Album;
use App\Models\AlbumImage;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home');
    }


    public function fetch_albums_images($id){

        $album_images= AlbumImage::where('album_id',$id)->with('album')->get();
        $images = [];
        foreach($album_images as $image) {
            $image = ' <a  style="text-decoration: none; " href="'. $image->photo .'" data-fancybox data-caption="'. $image->album->name .'">
                     <img src="'.url('/thumbnail') . '/' . $image->thumbnail .'" style="width: auto; height:200px; margin-left:20px; margin-bottom:20px" />
                </a>';

            array_push($images,$image);
        }

        return response()->json( $images );

    }
}
