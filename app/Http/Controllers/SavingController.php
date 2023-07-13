<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        $users = User::select('nis')->select('name')->orderBy('name')->get();
        return view('saving.index', [
            'title' => 'Data Tabungan',
            'savings' => Saving::all(),
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $saved = Saving::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }
    
    public function show($id)
    {
        $saving = Saving::find($id);
        return response()->json([
            'saving' => $saving
        ]);
    }

    public function update(Request $request, $id)
    {
        $saving = Saving::find($id);
        $data = $request->all();
        $updated = $saving->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }
    
    public function destroy($id)
    {
        $deleted = Saving::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
    
    public function search($nis)
    {
        $saving = Saving::where('number', $nis)->first();
        return response()->json([
            'saving' => $saving
        ]);
    }
}
