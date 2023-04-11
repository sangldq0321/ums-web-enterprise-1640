<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Role;
use Auth;
use DB;
use Hash;
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
            $latestIdea = Idea::latest('created_at')->first();
            $latestComment = Comment::latest('created_at')->first();
            $latestCommentIdeaName = Idea::where('ideaID', $latestComment->ideaID ?? '')->value('ideaName');
            $mostViewIdea = Idea::orderByDesc('view')->first();
            $mostLikeIdea = Idea::orderByDesc('likeCount')->first();
            $countComment = Comment::count();
            return view('index', compact('ideas', 'users', 'latestIdea', 'latestComment', 'countComment', 'mostViewIdea', 'mostLikeIdea', 'countDoc', 'countIdea', 'passDate', 'latestCommentIdeaName'));
        }
        $getRoleID = DB::table('users')
            ->select('*')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->get();
        $countAllIdea = $getRoleID->count();
        $countAcaIdea = $getRoleID->where('roleID', '=', 4)->count();
        $countSupIdea = $getRoleID->where('roleID', '=', 5)->count();
        $currentYear = date("Y");
        $countAcaIdeaMonth1 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '1')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth2 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '2')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth3 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '3')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth4 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '4')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth5 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '5')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth6 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '6')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth7 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '7')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth8 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '8')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth9 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '9')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth10 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '10')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth11 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '11')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countAcaIdeaMonth12 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '12')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 4)
            ->count();
        $countSupIdeaMonth1 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '1')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth2 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '2')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth3 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '3')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth4 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '4')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth5 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '5')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth6 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '6')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth7 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '7')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth8 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '8')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth9 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '9')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth10 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '10')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth11 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '11')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $countSupIdeaMonth12 = DB::table('users')
            ->join('ideas', 'users.userID', '=', 'ideas.uploader')
            ->whereMonth('ideas.created_at', '=', '12')
            ->whereYear('ideas.created_at', '=', $currentYear)
            ->where('roleID', '=', 5)
            ->count();
        $end = DB::table('academicyear')->value('close_date');
        return view('index', compact('end', 'countAllIdea', 'countAcaIdea', 'countSupIdea', 'countAcaIdeaMonth1', 'countAcaIdeaMonth2', 'countAcaIdeaMonth3', 'countAcaIdeaMonth4', 'countAcaIdeaMonth5', 'countAcaIdeaMonth6', 'countAcaIdeaMonth7', 'countAcaIdeaMonth8', 'countAcaIdeaMonth9', 'countAcaIdeaMonth10', 'countAcaIdeaMonth11', 'countAcaIdeaMonth12', 'countSupIdeaMonth1', 'countSupIdeaMonth2', 'countSupIdeaMonth3', 'countSupIdeaMonth4', 'countSupIdeaMonth5', 'countSupIdeaMonth6', 'countSupIdeaMonth7', 'countSupIdeaMonth8', 'countSupIdeaMonth9', 'countSupIdeaMonth10', 'countSupIdeaMonth11', 'countSupIdeaMonth12'));
    }
    public function markNoti(Request $request, $id_noti)
    {
        $noti = Notification::findOrFail($id_noti);
        $noti->isRead = 1;
        $noti->update();
        return redirect()->back();
    }
    public function manageAccount()
    {
        $users = DB::table('users')
            ->select('*')
            ->join('roles', 'users.roleID', '=', 'roles.roleID')
            ->get();
        return view('accounts.accountIndex', compact('users'));
    }
}
