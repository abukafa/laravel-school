<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(10);
        return response()->json([
            'data' => $payments
        ]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $payments = Payment::create([
            'invoice' => $request->invoice,
            'date' => $request->date,
            'nis' => $request->nis,
            'name' => $request->name,
            'guardian' => $request->guardian,
            'period_month' => $request->period_month,
            'period_year' => $request->period_year,
            'account' => $request->account,
            'remark' => $request->remark,
            'description' => $request->description,
            'amount' => $request->amount,
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
    public function edit(payment $payment)
    {
        //
    }
    public function update(Request $request, payment $payment)
    {
        $payment->invoice = $request->invoice;
        $payment->date = $request->date;
        $payment->nis = $request->nis;
        $payment->name = $request->name;
        $payment->guardian = $request->guardian;
        $payment->period_month = $request->period_month;
        $payment->period_year = $request->period_year;
        $payment->account = $request->account;
        $payment->remark = $request->remark;
        $payment->description = $request->description;
        $payment->amount = $request->amount;
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
