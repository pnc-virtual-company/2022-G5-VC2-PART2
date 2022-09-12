<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function store(Request $request)
    {
        $customMessage = [
            'required' => 'You forgot put this feild!',
        ];
        $this->validate($request, [
            'class' => 'required|max:10',
            'batch' => 'required|integer',
        ],$customMessage);

        $student = new Student();
        $student->id_student = $request->id_student;
        $student->class = $request->class;
        $student->batch = $request->batch;
        $student->phone = $request->phone;
        $student->save();

        return response()->json(['message' => 'Created Successfully']);
    }


    public function update(Request $request,$id)
    {
        $student = Student::findOrFail($id);
        $customMessage = [
            'required' => 'You forgot put this feild!',
        ];
        $this->validate($request, [
            'class' => 'required|max:10',
            'batch' => 'required|integer',
        ],$customMessage);
        $student->class = $request->class;
        $student->batch = $request->batch;
        $student->phone = $request->phone;
        $student->save();
    }

    public function destroy($id)
    {
        return Student::destroy($id);
    }

    public function getLastStudent() {
        return Student::latest()->first();
    }
}
