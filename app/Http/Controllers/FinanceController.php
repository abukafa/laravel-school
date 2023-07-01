<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $finances = Finance::paginate(10);
        return response()->json([
            'data' => $finances
        ]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $finances = Finance::create([
            'invoice' => $request->invoice,
            'date' => $request->date,
            'period_year' => $request->period_year,
            'vendor' => $request->vendor,
            'account' => $request->account,
            'remark' => $request->remark,
            'description' => $request->description,
            'debit' => $request->debit,
            'credit' => $request->credit,
            'admin' => $request->admin
        ]);
        return response()->json([
            'data' => $finances
        ]);
    }
    public function show(finance $finance)
    {
        return response()->json([
            'data' => $finance
        ]);
    }
    public function edit(finance $finance)
    {
        //
    }
    public function update(Request $request, finance $finance)
    {
        $finance->invoice = $request->invoice;
        $finance->date = $request->date;
        $finance->period_year = $request->period_year;
        $finance->vendor = $request->vendor;
        $finance->account = $request->account;
        $finance->remark = $request->remark;
        $finance->description = $request->description;
        $finance->debit = $request->debit;
        $finance->credit = $request->credit;
        $finance->admin = $request->admin;
        $finance->save();
        return response()->json([
            'data' => $finance
        ]);
    }
    public function destroy(finance $finance)
    {
        $finance->delete();
        return response()->json([
            'message' => 'Data finance dihapus!'
        ], 204);
    }
}
