<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\latest_project;
use \Illuminate\Support\Facades\URL;
class LatestProjectController extends Controller
{
    public function index(){
      $latest_projects = latest_project::get();
      return view('dashboard.latestProjectImages.index')->with('latest_projects',$latest_projects);
    }

    public function store(Request $request){
        if($request->has('image')) {
            foreach ($request->file('image') as $imagefile) {
                $images = new latest_project;
                $imageName = time().'-'.$imagefile->getClientOriginalName();
                $imagefile->move(public_path('latest_project'), $imageName);
                $images->image = URL::asset('/public/latest_project').'/'.$imageName;
                $images->save();
            }
        }

        return redirect()->route('latest-project-images')->with('success' ,'Images Uploaded Sucefully');
    }

    public function delete($id){
        $latest_image = latest_project::where('id',$id)->first();
        $latest_image->delete();
        return back()->with('success','image deleted Succefully');
    }
}
