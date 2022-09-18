<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    // Log In user
    public function confirmEmail(Request $request,$email) {
        // Check email and password
        $user = User::where('email', $email)->first();
        if ($user) {
            $password_status = true;
            if (!$user->password) {
                $password_status = false;
            }
            $response = ['email'=>$user->email,'id'=> $user->id, "email_status"=>true,'password_status'=>$password_status];
        } else{
            $response = ['email_status'=> false, 'password_status'=> false];
        }
        return response()->json($response );
    }
    public function setPasswordLogin(Request $request){
        $user = User::where('email',$request->email)->first();
        $response = ['password_status'=>false];
        if (Hash::check($request->password,$user->password)){
            $token = $user->createToken('mytoken')->plainTextToken;
            $response = ['user'=>$user,'password_status'=>true,'token'=>$token];
        }

        // Create token for login
        return response()->json($response);
    }

    // Create New Password
    public function createNewPassword(Request $request,$id) {
        $user = User::findOrFail($id);
        if($request->newPassword === $request->confirmPassword) {
            $user->password = bcrypt($request->confirmPassword);
            $user->save();
            return response()->json(['message' => 'Password created!']);
        }else {
            return response()->json(['message' => 'Password not match!']);
        }
    }
    // Log out user
    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User logout']);
    }

    // Create New User 
    public function registerUser(Request $request) {
        // Validation sign Up user
        $customMessage = [
            'required' => 'You forgot put this feild!',
            'unique' => 'This email already exist!*',
        ];

        $this->validate($request, [
            'email' => 'required|unique:users',
        ],$customMessage);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->password = null;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $ProfileImage = 'student_female.png';
        if ($request->gender == "Male") {
            $ProfileImage = 'student_male.png';
        }
        $user->profile = $ProfileImage; 
        if ($request->roles == "STUDENT"){
            $student = new Student();
            $user->student_id = $request->student_id;
            $student->batch_id = $request->batch_id;
            $student->class_id = $request->class_id;
            $student->date_birth = $request->date_birth;
            $idStudents = Student::where('students.batch_id','=',$request->batch_id)->get(['students.id_student']);
            // return $idStudents;
            foreach($idStudents as $idStudent) {
    
                if ($idStudent['id_student'] === $request->id_student){
                    // return abort(422,['message' => 'Id already exist!*']);
                    return response()->json(['message' => 'Id already exist!*'],402);
                }
            }
            $student->id_student = $request->id_student;
            $student->save();
        }

        // Sending email to user
        Mail::to($request->email)->send(new NewUserMail($user));
        $user->save();
        return response()->json(['message' => 'User created success!']);
    }

    // Get user by access token
    public function getUserByToken(){
        $user =  auth('sanctum')->user();
    }
    // Get all Student only
    public function studentOnly() {
        
        return User::join('students','users.student_id','=','students.id')->join('class_batches','students.class_id','=','class_batches.id')->join('batches','students.batch_id','=','batches.id')->get(['users.*','students.*','class_batches.*','batches.*']);
    }

    // Get all Teacher only
    public function teacherOnly() {
        return User::where('users.roles','=','TEACHER')->get(['users.id','users.first_name','users.last_name','users.email','users.roles','users.gender','users.phone','users.profile']);
    }

    // Show only one user (Teacher)
    public function showOneTeacher($id) {
        $userData = User::where('users.student_id','=',null)->findOrFail($id);
        return response()->json(['userData' => $userData]);
    }
    // Show only one user (student)
    public function showOneStudent($id) {
        $userData = User::where('users.student_id','=',$id)->get();
        $studentData = Student::join('class_batches','students.class_id','=','class_batches.id')->join('batches','batches.id','=','students.batch_id')->findOrFail($id);
        return response()->json(['userData' => $userData,'studentData' => $studentData]);
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
        $user->phone = $request->phone;
        if ($request->roles == 'STUDENT') {
            $student = Student::findOrFail($user->student_id);
            $student->id_student = $request->id_student;
            $student->batch_id = $request->batch_id;
            $student->class_id = $request->class_id;
            $student->date_birth = $request->date_birth;
            $student->save();
        }
        $user->save();
        return response()->json(['message' => 'Updated Success!']);
    }

    // Delete User 
    public function destroy($id) {
        if (User::where('users.student_id','=',$id)->delete()){
            Student::destroy($id);
        }else{
            User::destroy($id);
        }
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
        $path = storage_path('images/' . $imageName);

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
