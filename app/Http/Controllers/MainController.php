<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\likeAndDislike;
use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Session;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleID != 1) {
            $ideas = Idea::orderByDesc('created_at')->paginate(5);
            $users = User::all();
            $getCategory = Idea::value('categoryID');
            $categoryName = Category::where('categoryID', '=', $getCategory)->value('categoryName');
            $getUploader = Idea::value('uploader');
            $fullname = User::where('userID', '=', $getUploader)->value('fullname');
            $latestIdea = Idea::latest('created_at')->first();
            $latestComment = Comment::latest('created_at')->first();
            $mostViewIdea = Idea::orderByDesc('view')->first();
            $mostLikeIdea = Idea::orderByDesc('likeCount')->first();
            $countComment = Comment::count();
            return view('index', compact('ideas', 'categoryName', 'users', 'latestIdea', 'latestComment', 'countComment', 'mostViewIdea', 'mostLikeIdea'));
        }
        return view('index');
    }
}
