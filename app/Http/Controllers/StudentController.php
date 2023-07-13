<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function alumni()
    {
        return view('member.alumni', [
            'title' => 'Data Alumni',
            'students' => Student::where('rumble', 'Alumni')->orderBy('rumble')->get()
        ]);
    }

    public function index()
    {
        return view('member.student', [
            'title' => 'Data Siswa',
            'students' => Student::whereNotIn('rumble', ['Alumni'])->orderBy('rumble')->get()
        ]);
    }

    public function create()
    {
        return view('member.detail', [
            'title' => 'Data Siswa',
            'student' => []
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $saved = Student::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }
    
    public function show($id)
    {
        $student = Student::find($id);
        return response()->json([
            'student' => $student
        ]);
    }

    public function edit($id)
    {
        return view('member.detail', [
            'title' => 'Data Siswa',
            'student' => Student::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $data = $request->all();
        $updated = $student->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }
    
    public function destroy($id)
    {
        $deleted = Student::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
}
