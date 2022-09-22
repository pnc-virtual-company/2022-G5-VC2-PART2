<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function index() {
        return Comment::with('user.student','student')->get();
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
        $comment->text = $request->text;

        $comment->save();
        return response()->json(['message' => 'Comment updated!']);
    }

    public function destroy($id) {
        Comment::destroy($id);
        return response()->json(['message' => 'Comment deleted!']);
    }
}
