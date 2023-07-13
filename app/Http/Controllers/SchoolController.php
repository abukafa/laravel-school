<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;


class SchoolController extends Controller
{
    public function index()
    {
        return view('office.school', [
            'title' => 'Data Sekolah',
            'school' => School::first()
        ]);
    }

    public function save(Request $request)
    {
        $school = School::first();
        $data = $request->all();
        if($school){
            $school->update($data);
            return back()->with('success', 'Data Sekolah Berhasil diperbarui.');
        }else{
            School::create($data);
            return back()->with('success', 'Data Sekolah Berhasil ditambah.');
        }
    }
}
