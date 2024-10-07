<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;
use Session;

class ManagementController extends Controller
{
    public function index(){
        $managers = User::where('role','manager')->get();
        return view('dashboard.management.auth.register',compact('managers'));
    }


    public function store_register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);

        if(!$request->role == ""){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            return back()->with('register_complete' , "Registration Complete");
        }else{
            return back()->withErrors(['role' => "please , select role first"])->withInput();
        }


    }


    public function manager_down($id){
        $manager = User::where('id',$id)->first();


        if($manager->role == 'manager'){
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            return back()->with('register_complete' , "Manager Demotion Successfull");
        }
    }

    public function edit($id) {
        // Retrieve the specific user by their ID
        $manager = User::find($id);

        // Check if user exists
        if ($manager) {
            return view('dashboard.management.auth.edit', compact('manager'));
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }



    public function update(Request $request, $id) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required',
            'password' => 'nullable|min:8',  // password is optional, min length of 8 if provided
        ]);

        // Find the user by ID
        $manager = User::find($id);

        if ($manager) {
            // Update the name, email, and role
            $manager->name = $request->name;
            $manager->email = $request->email;
            $manager->role = $request->role;

            // Update the password only if provided
            if ($request->password) {
                $manager->password = bcrypt($request->password);  // Ensure password is hashed
            }

            // Save the updated user data
            $manager->save();

            return redirect()->route('management.edit', $manager->id)->with('success', 'Role & User updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }

    public function destroy($id) {
        $manager = User::find($id);

        if ($manager) {
            $manager->delete(); // Deletes the user
            return redirect()->route('management.index')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }

    //role manage

    public function role_index(){
        $bloggers = User::where('role','blogger')->get();
        $users = User::where('role','user')->where('block',false)->get();
        return view('dashboard.management.role.index',[
            'users' => $users,
            'bloggers' => $bloggers,
        ]);
    }

    public function role_assign(Request $request){

        $request->validate([
            'role' => 'required|in:manager,blogger,user',
        ]);

        $user = User::where('id',$request->user_id)->first();

        User::find($user->id)->update([
            'role' => $request->role,
            'update_at' => now(),
        ]);

        Session::flash('assign','Role Assign Successfull');

        return back();

    }


    public function blogger_grade_down($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'blogger'){
            User::find($user->id)->update([
                'role' => 'user',
                'update_at' => now(),
            ]);

            Session::flash('assign','Role down Successfull');

            return back();

        }
    }

    public function user_grade_down($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'block' => true,
                'update_at' => now(),
            ]);

            Session::flash('assign','block user Successfull');

            return back();

        }
    }

    //user delete
    public function role_destroy($id) {
        // Find the user by their ID and check if their role is 'user'
        $user = User::where('id', $id)->where('role', 'user')->first();

        // If the user is found and has the role 'user'
        if ($user) {
            $user->delete(); // Deletes the user
            return redirect()->route('management.role.index')->with('successfull', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('errorr', 'User not found or user does not have the "user" role!');
        }
    }

    //blogger delete

    public function role_blogger_destroy($id)
    {
        // Find the blogger by their ID and role
        $blogger = User::where('id', $id)->where('role', 'blogger')->first();

        // If the blogger is found, delete them
        if ($blogger) {
            $blogger->delete();
            return redirect()->route('management.role.index')->with('success', 'Blogger deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Blogger not found or does not have the "blogger" role!');
        }
    }




    //block user
    public function block_index(){
        $users = User::where('role','user')->where('block',true)->get();
        return view('dashboard.management.block_user.index',[
            'users' => $users,
        ]);
    }

    public function unblock_index($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'block' => false,
                'update_at' => now(),
            ]);

            Session::flash('unblock','Role unblock Successfull');

            return back();

        }
    }




}
