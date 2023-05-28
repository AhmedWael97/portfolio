<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clients;
use \Illuminate\Support\Facades\URL;
class ClientsController extends Controller
{
    public function index(){
        $clients_section = clients::get();
        return view('Dashboard.clients.index')->with('clients_section',$clients_section);
      }

      public function store(Request $request){
          if($request->has('image')) {
              foreach ($request->file('image') as $imagefile) {
                  $images = new clients;
                  $imageName = time().'-'.$imagefile->getClientOriginalName();
                  $imagefile->move(public_path('/clients-section'), $imageName);
                  $images->image = URL::asset('/public/clients-section').'/'.$imageName;
                  $images->save();
              }
          }

          return redirect()->route('clients-section-images')->with('success' ,'Images Uploaded Sucefully');
      }

      public function delete($id){
        $clients_section = clients::where('id',$id)->first();
        $clients_section->delete();
          return back()->with('success','image deleted Succefully');
      }
}
