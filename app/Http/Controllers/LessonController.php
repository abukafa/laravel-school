<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        return view('assess.lesson', ['title' => 'Data Pelajaran']);
    }
}
