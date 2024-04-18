<?php

namespace App\Http\Controllers\API;

use App\Models\Billing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingAPI extends Controller
{
    public function index()
    {
        $billings = Billing::paginate(10);
        return response()->json([
            'data' => $billings
        ]);
    }

    public function store(Request $request)
    {
        $billings = Billing::create([
            'year' => $request->year,
            'category' => $request->category,
            'account' => $request->account,
            'name' => $request->name,
            'amount' => $request->amount,
            'is_once' => $request->is_once,
            'is_monthly' => $request->is_monthly,
            'note' => $request->note,
        ]);
        return response()->json([
            'data' => $billings
        ]);
    }
    public function show(billing $billing)
    {
        return response()->json([
            'data' => $billing
        ]);
    }

    public function update(Request $request, billing $billing)
    {
        $billing->year = $request->year;
        $billing->category = $request->category;
        $billing->account = $request->account;
        $billing->name = $request->name;
        $billing->amount = $request->amount;
        $billing->is_once = $request->is_once;
        $billing->is_monthly = $request->is_monthly;
        $billing->note = $request->note;
        $billing->save();
        return response()->json([
            'data' => $billing
        ]);
    }

    public function destroy(billing $billing)
    {
        $billing->delete();
        return response()->json([
            'message' => 'Data Billing dihapus!'
        ], 204);
    }
}
