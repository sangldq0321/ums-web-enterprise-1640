<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use Auth;
use DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Models\Notification;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleID != 1) {
            $countDoc = Idea::count('document');
            $countIdea = Idea::count();
            $getAcaYears = DB::table('academicyear')->get();
            $now = date("Y-m-d");
            $start = DB::table('academicyear')->value('open_date');
            $end = DB::table('academicyear')->value('close_date');
            if ($now <= $end && $now >= $start) {
                $passDate = 0;
            } else {
                $passDate = 1;
            }
            $ideas = Idea::orderByDesc('created_at')->paginate(5);
            $users = User::all();
            $getCategory = Idea::value('categoryID');
            $categoryName = Category::where('categoryID', '=', $getCategory)->value('categoryName');
            $getUploader = Idea::value('uploader');
            $fullname = User::where('userID', '=', $getUploader)->value('fullname');
            $latestIdea = Idea::latest('created_at')->first();
            $latestComment = Comment::latest('created_at')->first();
            $latestCommentIdeaName = Idea::where('ideaID', $latestComment->ideaID)->value('ideaName');
            $mostViewIdea = Idea::orderByDesc('view')->first();
            $mostLikeIdea = Idea::orderByDesc('likeCount')->first();
            $countComment = Comment::count();
            return view('index', compact('ideas', 'categoryName', 'users', 'latestIdea', 'latestComment', 'countComment', 'mostViewIdea', 'mostLikeIdea', 'countDoc', 'countIdea', 'passDate', 'latestCommentIdeaName'));
        }
        $getRoleID = DB::table('users')
            ->select('*')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->get();
        $countAllIdea = $getRoleID->count();
        $countAcaIdea = $getRoleID->where('roleID', '=', 4)->count();
        $countSupIdea = $getRoleID->where('roleID', '=', 5)->count();
        $countIdeaMonth1 = Idea::whereMonth('created_at', '=', '1')->count();
        $countIdeaMonth2 = Idea::whereMonth('created_at', '=', '2')->count();
        $countIdeaMonth3 = Idea::whereMonth('created_at', '=', '3')->count();
        $countIdeaMonth4 = Idea::whereMonth('created_at', '=', '4')->count();
        $countIdeaMonth5 = Idea::whereMonth('created_at', '=', '5')->count();
        $countIdeaMonth6 = Idea::whereMonth('created_at', '=', '6')->count();
        $countIdeaMonth7 = Idea::whereMonth('created_at', '=', '7')->count();
        $countIdeaMonth8 = Idea::whereMonth('created_at', '=', '8')->count();
        $countIdeaMonth9 = Idea::whereMonth('created_at', '=', '9')->count();
        $countIdeaMonth10 = Idea::whereMonth('created_at', '=', '10')->count();
        $countIdeaMonth11 = Idea::whereMonth('created_at', '=', '11')->count();
        $countIdeaMonth12 = Idea::whereMonth('created_at', '=', '12')->count();

        return view('index', compact('countAllIdea', 'countAcaIdea', 'countSupIdea', 'countIdeaMonth1', 'countIdeaMonth2', 'countIdeaMonth3', 'countIdeaMonth4', 'countIdeaMonth5', 'countIdeaMonth6', 'countIdeaMonth7', 'countIdeaMonth8', 'countIdeaMonth9', 'countIdeaMonth10', 'countIdeaMonth11', 'countIdeaMonth12'));
    }
    public function markNoti(Request $request, $id_noti)
    {
        $noti = Notification::findOrFail($id_noti);
        $noti->isRead = 1;
        $noti->update();
        return redirect()->back();
    }
}
