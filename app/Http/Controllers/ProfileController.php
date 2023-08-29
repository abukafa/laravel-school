<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('users.profile', [
            'title' => 'Data Pengguna',
            'user' => Auth::user()
        ]);
    }

    public function image_upload(Request $request)
    {
        $data = $request->input('image');
        $image_parts = explode(";base64,", $data);
        $image_data = base64_decode($image_parts[1]);

        $imageName = session('user.id') . '.png';
        $imagePath = 'profile/' . $imageName;

        Storage::disk('public')->put($imagePath, $image_data);

        $user = Auth::user();
        $user->image = $imageName;
        $user->save();

        return response()->json(['image_path' => Storage::url($imagePath)]);
    }

    public function password_change(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'password' => 'required|min:8|confirmed',
        ]);
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        return back()->with('success', 'Password changed successfully.');
    }
}
