<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyComment;

class ReplyCommentController extends Controller
{
    public function store(Request $request) {
        $comment = new ReplyComment();
        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->student_id = $request->student_id;

        $comment->save();
        return response()->json(['message' => 'Comment created!']);
    }

    public function update(Request $request,$id) {
        $comment = ReplyComment::findOrFail($id);
        $comment->comment = $request->comment;

        $comment->save();
        return response()->json(['message' => 'Comment updated!']);
    }

    public function destroy($id) {
        ReplyComment::destroy($id);
        return response()->json(['message' => 'Comment deleted!']);
    }
}
