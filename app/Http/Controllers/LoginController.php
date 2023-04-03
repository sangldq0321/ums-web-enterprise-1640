<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('accounts.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
                'username.required' => 'Please enter username',
                'password.required' => 'Please enter password'
            ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('viewProfile', ['id' => Auth::user()->userID]);
        } else {
            return redirect('/login')->with('notify', 'loginfailed');
        }
    }
    public function logOut(Request $request)
    {
        $id_idea = $request->session()->get('ideaID');
        $viewIdea = 'idea_' . $id_idea;
        if (Session::has($viewIdea)) {
            $request->session()->forget($viewIdea);
        }
        Auth::logout();
        return redirect('/login')->with('notify', 'logoutsuccess');
    }
    public function getChangePassword()
    {
        return view('accounts.change-password');
    }
    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6',
        ]);
        $user = Auth::user();
        $beforeHashPass = $request->input('password');
        $afterHashPass = Hash::make($beforeHashPass);
        $user->password = $afterHashPass;
        $user->isPassReset = 1;
        $user->update();
        return redirect('/');
    }
    public function viewProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('accounts.view', compact('user'));
    }
    public function editProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('accounts.edit', compact('user'));
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('viewProfile', ['id' => Auth::user()->userID]);
    }
}
