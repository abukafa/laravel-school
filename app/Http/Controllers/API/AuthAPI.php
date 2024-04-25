<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthAPI extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'username' => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Pengguna sudah terdaftar');
        }
        $newUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'division' => $request->division,
            'position' => $request->position,
            'role' => $request->role,
            'image' => $request->image,
        ]);

        if ($newUser) {
            return response([
                'message' => 'Register successfull, Please Login!'
            ]);
        }else{
            return response([
                'message' => 'Register failed, Try again!'
            ], Response::HTTP_UNAUTHORIZED);
        };
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response([
                'message' => 'Invalid Credential'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $student = Student::where('id', $user->image)->first();

        if (!$student) {
            return response([
                'message' => 'Member data not found',
                'user' => $user
            ], Response::HTTP_NOT_FOUND);
        }
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'accessToken' => $token,
            'userData' => $student
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'You Logged out'
        ]);
    }
}
