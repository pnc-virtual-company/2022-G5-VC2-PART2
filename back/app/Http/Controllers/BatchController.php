<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\ClassBatch;
use App\Models\User;
use Illuminate\Http\Request;

class BatchController extends Controller
{
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
        $student = Student::where('students.batch_id','=',$id)->get(['students.id']);
        User::where('users.student_id','=',$student[0]->id)->delete();
        Student::where('students.batch_id','=',$student[0]->id)->delete();
        ClassBatch::where('class_batches.batch_id','=',$id)->delete();
        Batch::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
