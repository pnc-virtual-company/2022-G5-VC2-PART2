<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function getComment($student_id) {
        return Comment::where('comments.user_id','=',$student_id)->get();
    }

    public function store(Request $request) {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->student_id = $request->student_id;

        $comment->save();
        return response()->json(['message' => 'Comment created!']);
    }
}
