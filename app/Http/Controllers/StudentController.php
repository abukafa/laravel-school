<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function alumni()
    {
        return view('member.alumni', [
            'title' => 'Data Alumni',
            'students' => Student::where('graduation', '!=', '')->orderBy('graduation')->get()
        ]);
    }

    public function index()
    {
        return view('member.student', [
            'title' => 'Data Siswa',
            'students' => Student::whereNull('graduation')->orderBy('rumble')->get()
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
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:students',
        ]);
    
        if ($validator->fails()) {
            return back()->with('danger', 'NIS sudah terdaftar');
        }

        $data = $request->all();
        $saved = Student::create($data);
        if($saved){
            return redirect('/admin/siswa/' . $saved->id . '/edit')->with('success', 'Data berhasil disimpan');
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
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:students',
        ]);
    
        if ($validator->fails()) {
            return back()->with('danger', 'NIS sudah terdaftar');
        }

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

    public function image_upload(Request $request, $id)
    {
        $data = $request->input('image');
        $image_parts = explode(";base64,", $data);
        $image_data = base64_decode($image_parts[1]);

        $imageName = $id . '.png';
        $imagePath = 'member/' . $imageName;

        Storage::disk('public')->put($imagePath, $image_data);

        $student = Student::find($id);
        $student->image = $imageName;
        $student->save();

        return response()->json(['image_path' => Storage::url($imagePath)]);
    }
}
