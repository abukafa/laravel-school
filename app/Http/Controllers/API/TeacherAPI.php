<?php

namespace App\Http\Controllers\API;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TeacherAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate(10);
        return response()->json([
            'data' => $teachers
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
        $teachers = Teacher::create([
            'nig' => $request->nig,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'active' => $request->active,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'hamlet' => $request->hamlet,
            'village' => $request->village,
            'district' => $request->district,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'registered' => $request->registered,
            'grade' => $request->grade,
            'resign' => $request->resign,
            'update_job' => $request->update_job,
            'image' => $request->image,
            'note' => $request->note,
        ]);
        return response()->json([
            'data' => $teachers
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return response()->json([
            'data' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->nig = $request->nig;
        $teacher->name = $request->name;
        $teacher->nickname = $request->nickname;
        $teacher->gender = $request->gender;
        $teacher->active = $request->active;
        $teacher->birth_place = $request->birth_place;
        $teacher->birth_date = $request->birth_date;
        $teacher->address = $request->address;
        $teacher->hamlet = $request->hamlet;
        $teacher->village = $request->village;
        $teacher->district = $request->district;
        $teacher->city = $request->city;
        $teacher->postal_code = $request->postal_code;
        $teacher->phone = $request->phone;
        $teacher->registered = $request->registered;
        $teacher->grade = $request->grade;
        $teacher->resign = $request->resign;
        $teacher->update_job = $request->update_job;
        $teacher->image = $request->image;
        $teacher->note = $request->note;
        $teacher->save();

        return response()->json([
            'data' => $teacher
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json([
            'message' => 'Data Teacher dihapus!'
        ], 204);
    }
}
