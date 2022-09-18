<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getLastStudent() {
        return Student::latest()->first();
    }

    public function update($id){
        $student = Student::where('id',$id)->first();
        $student->status = !$student->status;
        $student->save();
        return response()->json(['message'=>'Added succesfully']);
    }
}
