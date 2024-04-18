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
            'invoice' => $request->invoice,
            'date' => $request->date,
            'ids' => $request->ids,
            'name' => $request->name,
            'credit' => $request->credit,
            'debit' => $request->debit,
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
        $saving->invoice = $request->invoice;
        $saving->date = $request->date;
        $saving->ids = $request->ids;
        $saving->name = $request->name;
        $saving->credit = $request->credit;
        $saving->debit = $request->debit;
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
