<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyComment;

class ReplyCommentController extends Controller
{
    public function store(Request $request) {
        $commentReply = new ReplyComment();
        $commentReply->comment_reply = $request->comment_reply;
        $commentReply->comment_id = $request->comment_id;

        $commentReply->save();
        return response()->json(['message' => 'Comment created!']);
    }

}
