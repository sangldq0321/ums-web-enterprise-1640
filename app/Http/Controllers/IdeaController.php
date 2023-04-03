<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\likeAndDislike;
use Auth;
use File;
use Illuminate\Http\Request;
use Session;
use ZipArchive;

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
        if ($request->hasfile('document')) {
            $file = $request->file('document');
            $filename = time() . '.' . $file->extension();
            $file->move('documents', $filename);
            $idea->document = $filename;
        }
        $idea->save();
        return redirect('/');
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
        if ($request->hasfile('document')) {
            $des = 'documents/' . $idea->document;
            File::delete($des);
            $file = $request->file('document');
            $filename = time() . '.' . $file->extension();
            $file->move('documents', $filename);
            $idea->document = $filename;
        }
        $idea->update();
        return redirect('/');
    }
    public function deleteIdea($id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $des = 'documents/' . $idea->document;
        File::delete($des);
        $idea->delete();
        return redirect('/');
    }
    public function viewIdea(Request $request, $id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $request->session()->put('ideaID', $id_idea);
        $getCategory = Idea::value('categoryID');
        $document = Idea::where('ideaID', session()->get('ideaID'))->value('document');
        $viewIdea = 'idea_' . $id_idea;
        if (!Session::has($viewIdea)) {
            Idea::where('ideaID', $id_idea)->increment('view');
            Session::put($viewIdea, 1);
        }
        $categoryName = Category::where('categoryID', '=', $getCategory)->value('categoryName');
        $comments = Comment::orderByDesc('created_at')->get();
        return view('ideas.view', compact('idea', 'categoryName', 'comments', 'document'));
    }
    public function likeIdea(Request $request, $id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $idea->likeCount = $idea->likeCount + 1;
        $idea->update();
        return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
    }
    public function dislikeIdea(Request $request, $id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $idea->likeCount = $idea->likeCount - 1;
        $idea->update();
        return redirect()->route('viewIdea', ['id' => $request->session()->get('ideaID')]);
    }
    public function downloadAllDoc(Request $request)
    {
        $countDoc = Idea::count('document');
        if ($countDoc > 0) {
            if ($request->session()->get('zipName')) {
                $des = 'temp/' . $request->session()->get('zipName');
                File::delete($des);
            }
            $zip = new ZipArchive();
            $fileName = time() . '.' . 'zip';
            if ($zip->open(public_path('temp/' . $fileName), ZipArchive::CREATE) == TRUE) {
                $files = File::files(public_path('documents'));
                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value, $relativeName);
                }
                $zip->close();
            }
            $request->session()->put('zipName', $fileName);
            return response()->download(public_path('temp/' . $fileName));
        } else {
            return redirect()->back();
        }
    }
}
