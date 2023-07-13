<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('office.account', [
            'title' => 'Data Akun',
            'accounts' => Account::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $saved = Account::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }
    
    public function show($id)
    {
        $account = Account::find($id);
        return response()->json([
            'account' => $account
        ]);
    }

    public function update(Request $request, $id)
    {
        $account = Account::find($id);
        $data = $request->all();
        $updated = $account->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }
    
    public function destroy($id)
    {
        $deleted = Account::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
    
    public function search($num)
    {
        $account = Account::where('number', $num)->first();
        return response()->json([
            'account' => $account
        ]);
    }
}
