<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $this->validate($request, [
            'commentContent' => 'required',
        ]);
        $comment = new Comment;
        $comment->userID = Auth::user()->userID;
        $comment->commentContent = $request->input('commentContent');
        $comment->ideaID = $request->session()->get('ideaID');
        $comment->save();
        return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
    }
    public function getEditComment($id_comment)
    {
        $comment = Comment::findOrFail($id_comment);
        return view('ideas.editComment', compact('comment'));
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
        $comment = Comment::findOrFail($id_comment);
        $comment->delete();
        return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
    }
}
