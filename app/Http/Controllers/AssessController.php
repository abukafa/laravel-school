<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessController extends Controller
{
    public function index()
    {
        return view('assess.index', ['title' => 'Data Nilai']);
    }
    public function detail()
    {
        return view('assess.detail', ['title' => 'Data Personal']);
    }
}