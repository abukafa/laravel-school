<?php

namespace App\Http\Controllers\API;

use App\Models\Saving;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SavingAPI extends Controller
{
    public function index()
    {
        $savings = Saving::paginate(10);
        return response()->json([
            'data' => $savings
        ]);
    }
    
    public function store(Request $request)
    {
        $savings = Saving::create([
            'date' => $request->date,
            'period_year' => $request->period_year,
            'nis' => $request->nis,
            'name' => $request->name,
            'guardian' => $request->guardian,
            'debit' => $request->debit,
            'credit' => $request->credit,
            'note' => $request->note,
            'admin' => $request->admin
        ]);
        return response()->json([
            'data' => $savings
        ]);
    }

    public function show(saving $saving)
    {
        return response()->json([
            'data' => $saving
        ]);
    }
    
    public function update(Request $request, saving $saving)
    {
        $saving->date = $request->date;
        $saving->period_year = $request->period_year;
        $saving->nis = $request->nis;
        $saving->name = $request->name;
        $saving->guardian = $request->guardian;
        $saving->debit = $request->debit;
        $saving->credit = $request->credit;
        $saving->note = $request->note;
        $saving->admin = $request->admin;
        $saving->save();
        return response()->json([
            'data' => $saving
        ]);
    }

    public function destroy(saving $saving)
    {
        $saving->delete();
        return response()->json([
            'message' => 'Data Tabungan dihapus!'
        ], 204);
    }
}
