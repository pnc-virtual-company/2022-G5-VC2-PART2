<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Sign In user


    // Create New User 
    public function signUp(Request $request) {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->roles = $request->roles;
        $user->profile = 'boy.png';

        $user->save();
        return response()->json(['message' => 'User created success!']);
    }

    // Get all Student only
    public function studentOnly() {
        return User::where('users.roles','=','STUDENT')->get();
    }

    // Get all Teacher only
    public function teacherOnly() {
        return User::where('users.roles','=','TEACHER')->get();
    }

    // Show only one user 
    public function show($id) {
        return User::findOrFail($id);
    }

    // Update user
    public function update(Request $request,$id) {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->roles = $request->roles;

        $user->save();
        return response()->json(['message' => 'Updated Success!']);
    }

    // Delete User 
    public function destroy($id) {
        User::destroy($id);
        return response()->json(['message' => 'Deleted Success!']);
    }

}
