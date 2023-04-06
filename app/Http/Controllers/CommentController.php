<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Notification;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $now = date("Y-m-d");
        $start = DB::table('academicyear')->value('open_date');
        $end = DB::table('academicyear')->value('close_date');
        if ($now <= $end && $now >= $start) {
            $this->validate($request, [
                'commentContent' => 'required',
            ]);
            $comment = new Comment;
            $comment->userID = Auth::user()->userID;
            $comment->commentContent = $request->input('commentContent');
            $comment->ideaID = $request->session()->get('ideaID');
            $comment->save();
            $noti = new Notification;
            $noti->userID = Auth::user()->userID;
            $noti->notiContent = "Someone is commented your idea";
            $noti->isRead = 0;
            $noti->notiFor = 'comment';
            $noti->ideaID = $request->session()->get('ideaID');
            $noti->save();
            return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
        }
        return redirect()->back();
    }
    public function getEditComment($id_comment)
    {
        $now = date("Y-m-d");
        $start = DB::table('academicyear')->value('open_date');
        $end = DB::table('academicyear')->value('close_date');
        $comment = Comment::findOrFail($id_comment);
        if ($comment->userID == Auth::user()->userID || $now <= $end && $now >= $start) {
            return view('ideas.editComment', compact('comment'));
        }
        return redirect()->back();
    }
    public function postEditComment(Request $request, $id_comment)
    {
        $comment = Comment::findOrFail($id_comment);
        $comment->commentContent = $request->input('commentContent');
        $comment->update();
        return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
    }
    public function deleteComment(Request $request, $id_comment)
    {
        $now = date("Y-m-d");
        $start = DB::table('academicyear')->value('open_date');
        $end = DB::table('academicyear')->value('close_date');
        $comment = Comment::findOrFail($id_comment);
        if ($comment->userID == Auth::user()->userID || $now <= $end && $now >= $start) {
            $comment->delete();
            return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
        }
        return redirect()->back();
    }
}
