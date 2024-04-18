<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentAPI extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(10);
        return response()->json([
            'data' => $payments
        ]);
    }

    public function store(Request $request)
    {
        $payments = Payment::create([
            'invoice' => $request->invoice,
            'date' => $request->date,
            'period' => $request->period,
            'ids' => $request->ids,
            'name' => $request->name,
            'category' => $request->category,
            'account' => $request->account,
            'billing' => $request->billing,
            'amount' => $request->amount,
            'is_once' => $request->is_once,
            'is_monthly' => $request->is_monthly,
            'admin' => $request->admin
        ]);
        return response()->json([
            'data' => $payments
        ]);
    }

    public function show(payment $payment)
    {
        return response()->json([
            'data' => $payment
        ]);
    }

    public function update(Request $request, payment $payment)
    {
        $payment->invoice = $request->invoice;
        $payment->date = $request->date;
        $payment->period = $request->period;
        $payment->ids = $request->ids;
        $payment->name = $request->name;
        $payment->category = $request->category;
        $payment->account = $request->account;
        $payment->billing = $request->billing;
        $payment->amount = $request->amount;
        $payment->is_once = $request->is_once;
        $payment->is_monthly = $request->is_monthly;
        $payment->admin = $request->admin;
        $payment->save();
        return response()->json([
            'data' => $payment
        ]);
    }

    public function destroy(payment $payment)
    {
        $payment->delete();
        return response()->json([
            'message' => 'Data Payment dihapus!'
        ], 204);
    }
}
