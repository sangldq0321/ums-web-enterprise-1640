<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

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
            return redirect('/')->with('notify', 'loginsuccess');

        } else {
            return redirect('/login')->with('notify', 'loginfailed');
        }
    }
    public function logOut()
    {
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
}
