<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use Auth;
use Illuminate\Http\Request;
use Session;

class IdeaController extends Controller
{
    public function ideaIndex()
    {
        $ideas = Idea::all();
        $getCategory = Idea::value('categoryID');
        $categoryName = Category::where('categoryID', '=', $getCategory)->value('categoryName');
        return view('ideas.index', compact('ideas', 'categoryName'));
    }
    public function getAddIdea()
    {
        $categories = Category::all();
        return view('ideas.add', compact('categories'));
    }
    public function postAddIdea(Request $request)
    {
        $this->validate($request, [
            'ideaName' => 'required',
            'categoryID' => 'required',
            'ideaContent' => 'required'
        ]);
        $idea = new Idea;
        $idea->ideaName = $request->input('ideaName');
        $idea->categoryID = $request->input('categoryID');
        $idea->ideaContent = $request->input('ideaContent');
        $idea->uploader = Auth::user()->userID;
        $idea->save();
        return redirect()->back();
    }
    public function getEditIdea($id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $categories = Category::all();
        return view('ideas.edit', compact('idea', 'categories'));
    }
    public function postEditIdea(Request $request, $id_idea)
    {
        $this->validate($request, [
            'ideaName' => 'required',
            'categoryID' => 'required',
            'ideaContent' => 'required'

        ]);
        $idea = Idea::findOrFail($id_idea);
        $idea->ideaName = $request->input('ideaName');
        $idea->categoryID = $request->input('categoryID');
        $idea->ideaContent = $request->input('ideaContent');
        $idea->update();
        return redirect('/categories');
    }
    public function deleteIdea($id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $idea->delete();
        return redirect('/');
    }
    public function viewIdea(Request $request, $id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $request->session()->put('ideaID', $id_idea);
        $getCategory = Idea::value('categoryID');
        $viewIdea = 'idea_' . $id_idea;
        if (!Session::has($viewIdea)) {
            Idea::where('ideaID', $id_idea)->increment('view');
            Session::put($viewIdea, 1);
        }
        $categoryName = Category::where('categoryID', '=', $getCategory)->value('categoryName');
        $comments = Comment::orderByDesc('created_at')->get();
        return view('ideas.view', compact('idea', 'categoryName', 'comments'));
    }
}
