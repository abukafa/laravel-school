<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function credit()
    {
        return view('finance.credit', ['title' => 'Data Pengeluaran']);
    }

    public function debit()
    {
        return view('finance.debit', ['title' => 'Data Pemasukan']);
    }
    
}
