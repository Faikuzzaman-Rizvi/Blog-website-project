<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }

    public function name_update(Request $request){
        $old_name = Auth::user()->name;
        $request->validate([
            'name' => 'required',
        ]);

        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'upadate_at' => now(),
        ]);
        return redirect()->route('profile.index')->with('name_update',"Name update success $old_name to $request->name");
    }


    public function email_update(Request $request){
           $old_email = Auth::user()->email;
            $request->validate([
            'email' => 'required|email',
        ]);

        User::find(auth()->id())->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);

        return redirect()->route('profile.index')->with('email_update',"Email update successfull $old_email to $request->email");
    }
}
