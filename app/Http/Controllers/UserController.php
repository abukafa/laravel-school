<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'title' => 'Data Pengguna',
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
        ]);
    
        if ($validator->fails()) {
            return back()->with('danger', 'Username sudah terdaftar');
        }
    
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $saved = User::create($data);
    
        if ($saved) {
            return back()->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('danger', 'Data gagal disimpan');
        }
    }
    
    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();
        $updated = $user->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }
    
    public function destroy($id)
    {
        $deleted = User::destroy($id);
        $filePath = 'profile/' . $id . '.png';
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
            Storage::disk('public')->delete('profile/' . $id . '.png');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
}