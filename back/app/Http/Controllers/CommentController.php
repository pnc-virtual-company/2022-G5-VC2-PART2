<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function getComment($user_id,$student_id) {
        $commentTeacher = Comment::where('comments.user_id','=',$user_id)->get();
        if ($commentTeacher !== '[]') {
            return Comment::where('comments.user_id','=',$user_id)->where('comments.student_id','=',$student_id)->get();
        }else
        {
            
        }
    }

    public function getCommentFromTeacher ($student_id) {
        $commentFromTeacher = Comment::where('comments.student_id','=',$student_id)->get();
        foreach ($commentFromTeacher as $commentFrom) {
            return Comment::where('comments.user_id','=',$commentFrom['user_id'])->where('comments.student_id','=',$commentFrom['student_id'])->get();
        }
        
    }

    public function store(Request $request) {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->student_id = $request->student_id;

        $comment->save();
        return response()->json(['message' => 'Comment created!']);
    }

    public function update(Request $request,$id) {
        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;

        $comment->save();
        return response()->json(['message' => 'Comment updated!']);
    }

    public function destroy($id) {
        Comment::destroy($id);
        return response()->json(['message' => 'Comment deleted!']);
    }
}
