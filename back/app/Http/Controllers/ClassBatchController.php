<?php

namespace App\Http\Controllers;

use App\Models\ClassBatch;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class ClassBatchController extends Controller
{
    // Get all class
    public function index() {
        return ClassBatch::get();
    }
    // Create New Class
    public function store(Request $request) {
        if (ClassBatch::where('class_batches.class_name','=',$request->class_name)->where('class_batches.batch_id','=',$request->batch_id)->first()) {
            return response()->json(['message' => 'This class already exist!*'],422);
        }
        $class = new ClassBatch();
        $class->class_name = $request->class_name;
        $class->batch_id = $request->batch_id;
        $class->save();
        return response()->json(['message' => 'Class created']);
    }

    // Update Class
    public function update(Request $request, $id) {
        $class = ClassBatch::findOrFail($id);
        if (ClassBatch::where('class_batches.class_name','=',$request->class_name)->first()) {
            return response()->json(['message' => 'This class already exist!*'],422);
        }
        $class->class_name = $request->class_name;
        $class->save();
        return response()->json(['message' => 'Class updated']);
    }

    public function show($id) {
        return ClassBatch::findOrFail($id);
    }

    // Delete Only one
    public function destroy($id) {
        $students = Student::where('students.class_id','=',$id)->get();
        if ($students !== '[]') {
            foreach ($students as $student) {
                Student::destroy($student['id']);
                User::where('users.student_id','=',$student['id'])->delete();
            }
        }
        ClassBatch::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
