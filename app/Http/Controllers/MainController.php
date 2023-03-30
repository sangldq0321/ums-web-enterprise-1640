<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function ideaIndex()
    {
        $ideas = Idea::all();
        $getUploader = Idea::value('uploader');
        $getCategory = Idea::value('categoryID');
        $fullname = User::where('userID', '=', $getUploader)->value('fullname');
        $categoryName = Category::where('categoryID', '=', $getCategory)->value('categoryName');
        return view('ideas.index', compact('ideas', 'fullname', 'categoryName'));
    }
    public function categoryIndex()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    public function getAddCategory()
    {
        return view('categories.add');
    }
    public function postAddCategory(Request $request)
    {
        $category = new Category;
        $category->categoryName = $request->input('categoryName');
        $category->categoryDesc = $request->input('categoryDesc');
        $category->save();
        return redirect('/categories');
    }
    public function getEditCategory($id_category)
    {
        $category = Category::findOrFail($id_category);
        return view('categories.edit', compact('category'));
    }
    public function postEditCategory(Request $request, $id_category)
    {
        $category = Category::findOrFail($id_category);
        $category->categoryName = $request->input('categoryName');
        $category->categoryDesc = $request->input('categoryDesc');
        $category->update();
        return redirect('/categories');
    }
    public function deleteCategory($id_category)
    {
        $category = Category::findOrFail($id_category);
        $category->delete();
        return redirect('/categories');
    }
    public function getAddIdea()
    {
        $categories = Category::all();
        return view('ideas.add', compact('categories'));
    }
    public function postAddIdea(Request $request)
    {
        $idea = new Idea;
        $idea->ideaName = $request->input('ideaName');
        $idea->categoryID = $request->input('categoryID');
        $idea->ideaContent = $request->input('ideaContent');
        $idea->uploader = Auth::user()->userID;
        $idea->save();
        return redirect('/ideas');
    }
    public function getEditIdea($id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $categories = Category::all();
        return view('ideas.edit', compact('idea', 'categories'));
    }
    public function postEditIdea(Request $request, $id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $idea->ideaName = $request->input('ideaName');
        $idea->categoryID = $request->input('categoryID');
        $idea->ideaContent = $request->input('ideaContent');
        $idea->update();
        return redirect('/ideas');
    }
    public function deleteIdea($id_idea)
    {
        $idea = Idea::findOrFail($id_idea);
        $idea->delete();
        return redirect('/ideas');
    }
}
