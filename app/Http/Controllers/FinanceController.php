<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Account;
use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $invoices = Finance::select('invoice')
            ->selectRaw('MIN(date) AS date')
            ->selectRaw('MIN(remark) AS remark')
            ->selectRaw('COUNT(*) AS items')
            ->selectRaw('SUM(amount) AS total')
            ->groupBy('invoice')
            ->get();

        return view('finance.index', [
            'title' => 'Data Keuangan',
            'finances' => $invoices
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $saved = Finance::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }
    
    public function show($id)
    {
        $finance = Finance::find($id);
        return response()->json([
            'finance' => $finance
        ]);
    }

    public function update(Request $request, $id)
    {
        $finance = Finance::find($id);
        $data = $request->all();
        $updated = $finance->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }
    
    public function destroy($id)
    {
        $deleted = Finance::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
    
    public function detail($inv)
    {
        $accounts = Account::all();
        $items = Finance::where('invoice', $inv)->get();
        $total = 0;
        foreach($items as $i){ $total += $i->amount; }
        return view('finance.detail', [
            'title' => 'Data Keuangan',
            'invoice' => $inv,
            'total' => $total,
            'items' => $items,
            'accounts' => $accounts
        ]);
    }
    
    public function preview($inv)
    {
        $school = School::first();
        $items = Finance::where('invoice', $inv)->get();
        $total = 0;
        foreach($items as $i){ $total += $i->amount; }
        return view('finance.preview', [
            'title' => 'Data Keuangan',
            'total' => $total,
            'items' => $items,
            'school' => $school
        ]);
    }
    
}
