<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(Request $request, $postId){
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->post_id = $postId;
        $comment->user_id = Auth::id();
        $comment->save();

        return back();

    }

    public function storeReplyComment(Request $request, $postId){
        // dd($request->content);
        $reply = new Reply();
        $reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->post_id = $postId;
        $reply->comment_id = $request->comment_id;
        $reply->save();

        return back();
    }

    public function comment_delete(Request $request){
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return back();
    }

    public function reply_delete(Request $request){
        $reply = Reply::find($request->reply_id);
        $reply->delete();
        return back();
    }

    public function comment_update(Request $request){
        $comment = Comment::find($request->comment_id);
        $comment->content = $request->content;
        $comment->save();
        return back();
    }
    
    public function reply_update(Request $request){
        $reply = Reply::find($request->reply_id);
        $reply->content = $request->content;
        $reply->save();
        return back();
    }

    public function comment_report(Request $request){
        $report = new Report();
        $report->user_id = Auth::id();
        $report->comment_id = $request->comment_id;
        $report->message = $request->message;
        $report->type_id = $request->type_id;
        $report->save();
        // dd($report);
        return back();
    }

    public function reply_report(Request $request){
        $report = new Report();
        $report->user_id = Auth::id();
        $report->reply_id = $request->reply_id;
        $report->message = $request->message;
        $report->type_id = $request->type_id;
        $report->save();
        // dd($report);
        return back();
    }

    public function post_report(Request $request){
        $report = new Report();
        $report->user_id = Auth::id();
        $report->post_id = $request->post_id;
        $report->message = $request->message;
        $report->type_id = $request->type_id;
        $report->save();
        // dd($report);
        return back();
    }
}
