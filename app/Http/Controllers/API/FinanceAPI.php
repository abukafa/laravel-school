<?php

namespace App\Http\Controllers\API;

use App\Models\Finance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceAPI extends Controller
{
    public function index()
    {
        $finances = Finance::paginate(10);
        return response()->json([
            'data' => $finances
        ]);
    }

    public function store(Request $request)
    {
        $finances = Finance::create([
            'invoice' => $request->invoice,
            'date' => $request->date,
            'vendor' => $request->vendor,
            'account' => $request->account,
            'remark' => $request->remark,
            'description' => $request->description,
            'amount' => $request->amount,
            'admin' => $request->admin,
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

    public function update(Request $request, finance $finance)
    {
        $finance->invoice = $request->invoice;
        $finance->date = $request->date;
        $finance->vendor = $request->vendor;
        $finance->account = $request->account;
        $finance->remark = $request->remark;
        $finance->description = $request->description;
        $finance->amount = $request->amount;
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
