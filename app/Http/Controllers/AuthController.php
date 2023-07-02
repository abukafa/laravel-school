<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('auth.login', ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {

            // $user = Auth::user();
            // if (!$user->is_approved) {
            //     Auth::logout();
            //     return back()->with('loginError', 'Your account is not approved yet!');
            // }

            $request->session()->regenerate();
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
