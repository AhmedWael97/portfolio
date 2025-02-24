<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\URL;
class usersController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $users = User::get();
        return view('Dashboard.users.index')->with(['users'=> $users]);
    }

    public function create() {
        return view('Dashboard.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8',
        
            
        ]);

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->phone = $request->phone;
        $newUser->note = $request->note;
        $newUser->price = $request->price;
        $newUser->date = $request->date;
        //$newUSer->session_date = $request->session_date;
        $newUser->password = Hash::make($request->password);
        $newUser->email = $request->email.'@refaatphotography.com';
       
        $newUser->save();
        return redirect()->route('user-index')->with('success','Saved Succefully');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('Dashboard.users.update')->with([
            'user' => $user,
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            
        ]);

        $user = User::findOrFail($request->id);
   
        if(!User::where('email',$request->email)->where('id','!=',$request->id)->first()) {
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->note = $request->note;
            $user->price = $request->price;
            $user->date = $request->date;
            $user->email = $request->email;
            if($request->password != null) {
                $user->password = Hash::make($request->password);
            }
           
            $user->save();
            return redirect()->route('user-index')->with('success','Updated Succfully');

        } else {
            return back()->with('warning','this Email has been Taken');
        }
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user-index')->with('success','Deleted Succefully');
    }
}
