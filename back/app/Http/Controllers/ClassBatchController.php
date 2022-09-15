<?php

namespace App\Http\Controllers;

use App\Models\ClassBatch;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class ClassBatchController extends Controller
{
    // Create New Class
    // public function store(Request $request) {
    //     $class = new ClassBatch();
    //     $class->class_name = $request->class_name;
    //     $class->batch_id = $request->batch_id;
    //     $class->save();
    //     return response()->json(['message' => 'Class created']);
    // }

    // // Update Class
    // public function update(Request $request, $id) {
    //     $class = ClassBatch::findOrFail($id);
    //     $class->class_name = $request->class_name;
    //     $class->save();
    //     return response()->json(['message' => 'Class updated']);
    // }

    // public function show($id) {
    //     return ClassBatch::findOrFail($id);
    // }

    // // Delete Only one
    // public function destroy($id) {
    //     $student = Student::where('students.class_id','=',$id)->get(['students.id']);
    //     User::where('users.student_id','=',$student[0]->id)->delete();
    //     Student::where('students.class_id','=',$id)->delete();
    //     ClassBatch::destroy($id);
    //     return response()->json(['message' => 'Deleted']);
    // }
}
