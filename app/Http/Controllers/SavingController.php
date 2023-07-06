<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        return view('saving.index', ['title' => 'Data Tabungan']);
    }

    public function saving()
    {
        return view('saving.saving', ['title' => 'Saldo Tabungan']);
    }
}
