<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    // Sign In user


    // Create New User 
    public function registerUser(Request $request) {
        // Validation sign Up user
        $customMessage = [
            'required' => 'You forgot put this feild!',
            'unique' => 'This email already exist!',
        ];

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'roles' => 'required',
        ],$customMessage);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->roles = $request->roles;
        $user->gender = $request->gender;
        $user->student_id = $request->student_id;

        $user->save();
        return response()->json(['message' => 'User created success!']);
    }

    // Get all Student only
    public function studentOnly() {
        return User::join('students','users.student_id','=','students.id')->get(['users.*','students.*']);
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
        // Validation sign Up user
        $customMessage = [
            'required' => 'You forgot put this feild!',
            'max' => 'You must put max 15 charater!',
        ];

        $this->validate($request, [
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
            'roles' => 'required|string',
            'gender' => 'required|string',
        ],$customMessage);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->gender = $request->gender;
        $user->save();
        return response()->json(['message' => 'Updated Success!']);
    }

    // Delete User 
    public function destroy($id) {
        User::destroy($id);
        return response()->json(['message' => 'Deleted Success!']);
    }

    // Reset password
    public function resetPassword(Request $request, $id) {
        $user = User::findOrFail($id);
        if (Hash::check($request->currentPassword,$user->password)) {
            if ($request->newPassword == $request->confirmPassword) {
                $user->password = Hash::make($request->newPassword);
                $user->save();
                return response()->json(['message' => 'Password Updated!']);
            }
            else{
                return response()->json(['message' => 'Confirm password does not match!']);
            }
        }
        else {
            return response()->json(['message' => 'Current password incorrect!']);
        }
    }

    // Update Profile user
    public function updateProfile(Request $request, $id) {
        $user = User::findOrFail($id);
        $path = public_path('images/'.$user->profile);
        if (File::exists($path)) {
            File::delete($path);
        }

        $image = $request->profile;
        $newImageName = date('j-F-Y-H-i-s-A').$image->getClientOriginalName();
        $image->move(public_path('images'),$newImageName);
        $user->profile = $newImageName;
        $user->save();

        return response()->json(['message' => 'Profile Updated!']);
    }

    // Get Profile user
    public function getProfile($imageName) {
        $path = public_path('images/' . $imageName);

        if (File::exists($path)) {
            $file = File::get($path);
        }else{
            abort(404);
        }

        $type = File::mimeType($path);
        $response = Response::make($file,200);
        $response->header('Content-Type',$type);

        return $response;
    }

}
