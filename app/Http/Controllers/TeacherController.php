<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.teacher', [
            'title' => 'Data Guru', 
            'teachers' => Teacher::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.teacherDetail', [
            'title' => 'Data Guru',
            'teacher' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nig' => 'required|unique:teachers',
        ]);
    
        if ($validator->fails()) {
            return back()->with('danger', 'NIG sudah terdaftar');
        }

        $data = $request->all();
        $saved = Teacher::create($data);
        if($saved){
            return redirect('/admin/guru/' . $saved->id . '/edit')->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'student' => Teacher::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('member.teacherDetail', [
            'title' => 'Data Guru',
            'teacher' => Teacher::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $data = $request->all();
        $updated = $teacher->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Teacher::destroy($id);
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
        $imagePath = 'guru/' . $imageName;

        Storage::disk('public')->put($imagePath, $image_data);

        $teacher = Teacher::find($id);
        $teacher->image = $imageName;
        $teacher->save();

        return response()->json(['image_path' => Storage::url($imagePath)]);
    }
}
