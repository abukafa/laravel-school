<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $invoices = Payment::select('invoice')
            ->selectRaw('MIN(date) AS date')
            ->selectRaw('MIN(name) AS name')
            ->selectRaw('COUNT(*) AS items')
            ->selectRaw('SUM(amount) AS total')
            ->groupBy('invoice')
            ->get();

        return view('payment.index', [
            'title' => 'Data Pembayaran',
            'payments' => $invoices
        ]);
    }
    
    public function detail($inv = NULL)
    {
        $billings = Billing::all();
        $students = Student::all();
        $items = [];
        $total = 0;
        if ($inv == NULL) {
            $items = Payment::where('invoice', $inv)->get();
            foreach($items as $i){ $total += $i->amount; }
        }
        return view('payment.detail', [
            'title' => 'Data Pembayaran',
            'invoice' => $inv,
            'total' => $total,
            'items' => $items,
            'billings' => $billings,
            'students' => $students
        ]);
    }
    
    public function preview($inv)
    {
        $school = School::first();
        $total = 0;
        $items = Payment::where('invoice', $inv)->get();
        foreach($items as $i){ $total += $i->amount; }
        return view('payment.preview', [
            'title' => 'Data Pembayaran',
            'total' => $total,
            'items' => $items ? $items : [],
            'school' => $school
        ]);
    }

    public function confirm()
    {
        return view('payment.confirm', ['title' => 'Konfirmasi Pembayaran']);
    }
}
