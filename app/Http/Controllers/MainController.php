<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\likeAndDislike;
use Auth;
use DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Session;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleID != 1) {
            $countDoc = Idea::count('document');
            $countIdea = Idea::count();
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
            return view('index', compact('ideas', 'categoryName', 'users', 'latestIdea', 'latestComment', 'countComment', 'mostViewIdea', 'mostLikeIdea', 'countDoc', 'countIdea'));
        }
        $getRoleID = DB::table('users')
            ->select('*')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->get();
        $countAllIdea = $getRoleID->count();
        $countAcaIdea = $getRoleID->where('roleID', '=', 4)->count();

        $countAcaIdeaMonth1 = Idea::whereMonth('created_at', '=', '1')->count();
        $countAcaIdeaMonth2 = Idea::whereMonth('created_at', '=', '2')->count();
        $countAcaIdeaMonth3 = Idea::whereMonth('created_at', '=', '3')->count();
        $countAcaIdeaMonth4 = Idea::whereMonth('created_at', '=', '4')->count();
        $countAcaIdeaMonth5 = Idea::whereMonth('created_at', '=', '5')->count();
        $countAcaIdeaMonth6 = Idea::whereMonth('created_at', '=', '6')->count();
        $countAcaIdeaMonth7 = Idea::whereMonth('created_at', '=', '7')->count();
        $countAcaIdeaMonth8 = Idea::whereMonth('created_at', '=', '8')->count();
        $countAcaIdeaMonth9 = Idea::whereMonth('created_at', '=', '9')->count();
        $countAcaIdeaMonth10 = Idea::whereMonth('created_at', '=', '10')->count();
        $countAcaIdeaMonth11 = Idea::whereMonth('created_at', '=', '11')->count();
        $countAcaIdeaMonth12 = Idea::whereMonth('created_at', '=', '12')->count();

        $countSupIdea = $getRoleID->where('roleID', '=', 5)->count();
        return view('index', compact('countAllIdea', 'countAcaIdea', 'countSupIdea', 'countAcaIdeaMonth1', 'countAcaIdeaMonth2', 'countAcaIdeaMonth3', 'countAcaIdeaMonth4', 'countAcaIdeaMonth5', 'countAcaIdeaMonth6', 'countAcaIdeaMonth7', 'countAcaIdeaMonth8', 'countAcaIdeaMonth9', 'countAcaIdeaMonth10', 'countAcaIdeaMonth11', 'countAcaIdeaMonth12'));
    }
}
