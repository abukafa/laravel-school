<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index', ['title' => 'Data Pembayaran']);
    }
    public function confirm()
    {
        return view('payment.confirm', ['title' => 'Konfirmasi Pembayaran']);
    }
}
