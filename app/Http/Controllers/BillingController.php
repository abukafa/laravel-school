<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::paginate(10);
        return response()->json([
            'data' => $billings
        ]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $billings = Billing::create([
            'period_year' => $request->period_year,
            'class' => $request->class,
            'account' => $request->account,
            'remark' => $request->remark,
            'description' => $request->description,
            'amount' => $request->amount,
            'admin' => $request->admin
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
    public function edit(billing $billing)
    {
        //
    }
    public function update(Request $request, billing $billing)
    {
        $billing->period_year = $request->period_year;
        $billing->class = $request->class;
        $billing->account = $request->account;
        $billing->remark = $request->remark;
        $billing->description = $request->description;
        $billing->amount = $request->amount;
        $billing->admin = $request->admin;
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
