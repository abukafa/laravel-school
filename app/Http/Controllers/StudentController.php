<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student()
    {
        return view('member.student', ['title' => 'Data Siswa']);
    }

    public function alumni()
    {
        return view('member.alumni', ['title' => 'Data Alumni']);
    }
}
