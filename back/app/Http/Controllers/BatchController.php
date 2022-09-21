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
        $batch = new Batch();
        $batch->year = $request->year;
        $batch->save();
        return response()->json(['message' => 'Batch created']);
    }

    // Update Batch
    public function update(Request $request, $id) {
        $batch = Batch::findOrFail($id);
        $batch->year = $request->year;
        $batch->save();
        return response()->json(['message' => 'Batch updated']);
    }

    // Show batch by Id
    public function show($id) {
        return Batch::findOrFail($id);
    }

    public function destroy($id) {
        $student = Student::where('students.batch_id','=',$id)->first();
        if ($student){
            User::where('users.student_id','=',$student->id)->delete();
            Student::where('students.batch_id','=',$student->id)->delete();
        }
        ClassBatch::where('class_batches.batch_id','=',$id)->delete();
        Batch::destroy($id);
        return response()->json(['message' => 'Deleted']);
        // return response()->json($student);
    }
}
