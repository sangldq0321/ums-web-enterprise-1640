<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        if (User::where('username', $request->username)->where('status', 0)->exists()) {
            return redirect()->route('login')->with('notify', 'userdisable');
        }
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/')->with('notify', 'loginsuccess');
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
        Auth::logout();
        return redirect('/');
    }
    public function viewProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->roleID == Auth::user()->roleID) {
            return view('accounts.view', compact('user'));
        }
        return redirect()->back();
    }
    public function editProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->userID == Auth::user()->userID) {
            return view('accounts.edit', compact('user'));
        }
        return redirect()->back();
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('viewProfile', ['id' => Auth::user()->userID]);
    }
    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->roleID == 1) {
            $password = 'Admin@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;
        } elseif ($user->roleID == 2) {
            $password = 'Qa@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;

        } elseif ($user->roleID == 3) {
            $password = 'Qac@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;
        } elseif ($user->roleID == 4 || $user->roleID == 5) {
            $password = 'Staff@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;
        }
        $user->isPassReset = 0;
        $user->update();
        return redirect('/manage/accounts');
    }
    public function getAddAccount()
    {
        $roles = Role::all();
        return view('accounts.add', compact('roles'));
    }
    public function postAddAccount(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'fullname' => 'required',
            'roleID' => 'required',
        ]);
        $user = new User;
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->roleID = $request->roleID;
        if ($user->roleID == 1) {
            $password = 'Admin@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;
        } elseif ($user->roleID == 2) {
            $password = 'Qa@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;

        } elseif ($user->roleID == 3) {
            $password = 'Qac@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;
        } elseif ($user->roleID == 4 || $user->roleID == 5) {
            $password = 'Staff@123';
            $hashedPass = Hash::make($password);
            $user->password = $hashedPass;
        }
        $user->isPassReset = 0;
        $user->save();
        return redirect('/manage/accounts');
    }
    public function enableAccount($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->status = 1;
        $user->update();
        return redirect()->back();
    }
    public function disableAccount($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->status = 0;
        $user->update();
        return redirect()->back();
    }
}
