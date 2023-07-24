<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function home1()
    {
        return view('auth.home1', ['title' => 'Beranda Akademis']);
    }

    public function home2()
    {
        return view('auth.home2', ['title' => 'Beranda Keuangan']);
    }

    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'school' => School::first()
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $school = School::first();
            $role = ($user->role == 5 ? 'Maintainer' : ($user->role == 4 ? 'Auditor' : ($user->role == 3 ? 'Supervisor' : ($user->role == 2 ? 'Administrator' : 'User'))));
            session()->put('user', $user);
            session()->put('rolename', $role);
            session()->put('school', $school);
            return redirect()->intended('/');
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function lockscreen()
    {
        return view('auth.lockscreen', ['title' => 'Kunci Layar']);
    }

    public function unlockscreen(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => Auth::user()->username, 'password' => $request->password])) {
            $request->session()->forget('lockscreen');
            $user = Auth::user();
            $school = School::first();
            $role = ($user->role == 5 ? 'Maintainer' : ($user->role == 4 ? 'Auditor' : ($user->role == 3 ? 'Supervisor' : ($user->role == 2 ? 'Administrator' : 'User'))));
            session()->put('user', $user);
            session()->put('rolename', $role);
            session()->put('school', $school);
            return redirect('/home');
        } else {
            return back()->with('loginError', 'Login failed!');
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
