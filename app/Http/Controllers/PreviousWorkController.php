<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;
use App\Models\previous_work;
class PreviousWorkController extends Controller
{
    public function index(){
        $previous_works = previous_work::get();
        return view('dashboard.previousWork.index')->with('previous_works',$previous_works);
      }
  
      public function store(Request $request){
          if($request->has('image')) {
              foreach ($request->file('image') as $imagefile) {
                  $images = new previous_work;
                  $imageName = time().'-'.$imagefile->getClientOriginalName();
                  $imagefile->move(public_path('previous_work'), $imageName);
                  $images->image = URL::asset('/public/previous_work').'/'.$imageName;
                  $images->save();
              }
          }
  
          return redirect()->route('latest-project-images')->with('success' ,'Images Uploaded Sucefully');
      }
  
      public function delete($id){
          $latest_image = previous_work::where('id',$id)->first();
          $latest_image->delete();
          return back()->with('success','image deleted Succefully');
      }
}
