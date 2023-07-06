<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        return view('payment.billing', ['title' => 'Data Tagihan']);
    }
}
