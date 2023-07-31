<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saving;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        return view('saving.index', [
            'title' => 'Data Tabungan',
            'savings' => Saving::all(),
            'students' => Student::all()
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
    
    public function search($ids)
    {
        $saving = Saving::where('ids', $ids)->first();
        return response()->json([
            'saving' => $saving
        ]);
    }
    
    public function preview($ids)
    {
        $school = School::first();
        $items = Saving::where('ids', $ids)->get();
        $debit = 0;
        $credit = 0;
        foreach($items as $i){ 
            $debit += $i->debit; 
            $credit += $i->credit; 
        }
        return view('saving.preview', [
            'title' => 'Data Keuangan',
            'debit' => $debit,
            'credit' => $credit,
            'saldo' => $credit - $debit,
            'items' => $items,
            'school' => $school
        ]);
    }
}
