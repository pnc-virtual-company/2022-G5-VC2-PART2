<?php

namespace App\Http\Controllers;
use App\Models\Followup;
use Illuminate\Http\Request;
class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Followup::join('students','students.id','=','followups.student_id')->join('users','users.student_id','=','students.id')->join('class_batches','class_batches.id','=','students.class_id')->join('batches','students.batch_id','=','batches.id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $followup = new Followup();
        $followup->student_id = $request->student_id;
        $followup->user_id = $request->user_id;
        $followup->type = $request->type;
        $followup->description = $request->description;
        $followup->status = true;

        $followup->save();

        return response()->json(['message' => 'The student has added to follow up succesfully.'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $followupInfo = Followup::where('followups.student_id','=',$id)->first();
        return response()->json([$followupInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Followup $followup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Followup::destroy($id);
        return response()->json(['message', 'Folow up had deleted']);
    }
}
