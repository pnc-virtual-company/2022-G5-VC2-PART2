<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\ClassBatch;
use App\Models\User;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index () {
        return Batch::with('classes.students.user')->get();
    }
    // Create New batch
    public function store(Request $request) {
        // Validation Create new Class
        $customMessage = [
            'unique' => 'This year already exist!*',
        ];

        $this->validate($request, [
            'year' => 'unique:batches',
        ],$customMessage);
        $batch = new Batch();
        $batch->year = $request->year;
        $batch->save();
        return response()->json(['message' => 'Batch created']);
    }

    // Update Batch
    public function update(Request $request, $id) {
        $batch = Batch::findOrFail($id);
        $customMessage = [
            'unique' => 'This year already exist!*',
        ];

        $this->validate($request, [
            'year' => 'unique:batches',
        ],$customMessage);
        $batch->year = $request->year;
        $batch->save();
        return response()->json(['message' => 'Batch updated']);
    }

    // Show batch by Id
    public function show($id) {
        return Batch::findOrFail($id);
    }

    public function destroy($id) {
        $students = Student::where('students.batch_id','=',$id)->get();
        $classes = ClassBatch::where('class_batches.batch_id','=',$id)->get();
        if ($students !== '[]'){
            foreach($students as $student) {
                User::where('users.student_id','=',$student['id'])->delete();
                Student::where('students.batch_id','=',$student['batch_id'])->delete();
            }
        }
        if ($classes) {
            foreach($classes as $class) {
                ClassBatch::where('class_batches.batch_id','=',$class['batch_id'])->delete();
            }
        }
        Batch::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
