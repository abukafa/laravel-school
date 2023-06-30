<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return response()->json([
            'data' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'gender' => $request->gender,
            'rumble' => $request->rumble,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'child_num' => $request->child_num,
            'family_status' => $request->family_status,
            'sibling_num' => $request->sibling_num,
            'address' => $request->address,
            'hamlet' => $request->hamlet,
            'village' => $request->village,
            'district' => $request->district,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'hobby' => $request->hobby,
            'sport' => $request->sport,
            'ambition' => $request->ambition,
            'height' => $request->height,
            'weight' => $request->weight,
            'distance' => $request->distance,
            'time' => $request->time,
            'father' => $request->father,
            'father_birth_place' => $request->father_birth_place,
            'father_birth_date' => $request->father_birth_date,
            'father_education' => $request->father_education,
            'father_note' => $request->father_note,
            'mother' => $request->mother,
            'mother_birth_place' => $request->mother_birth_place,
            'mother_birth_date' => $request->mother_birth_date,
            'mother_education' => $request->mother_education,
            'mother_note' => $request->mother_note,
            'job' => $request->job,
            'income' => $request->income,
            'phone' => $request->phone,
            'guardian' => $request->guardian,
            'guardian_relationship' => $request->guardian_relationship,
            'guardian_phone' => $request->guardian_phone,
            'illness' => $request->illness,
            'performance' => $request->performance,
            'photo' => $request->photo,
            'graduation' => $request->graduation,
            'next_school' => $request->next_school,
            'next_school_address' => $request->next_school_address,
            'last_activity' => $request->last_activity
        ]);
        return response()->json([
            'data' => $students
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        return response()->json([
            'data' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        $student->name = $request->name;
        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->nick_name = $request->nick_name;
        $student->gender = $request->gender;
        $student->rumble = $request->rumble;
        $student->birth_place = $request->birth_place;
        $student->birth_date = $request->birth_date;
        $student->child_num = $request->child_num;
        $student->family_status = $request->family_status;
        $student->sibling_num = $request->sibling_num;
        $student->address = $request->address;
        $student->hamlet = $request->hamlet;
        $student->village = $request->village;
        $student->district = $request->district;
        $student->city = $request->city;
        $student->postal_code = $request->postal_code;
        $student->hobby = $request->hobby;
        $student->sport = $request->sport;
        $student->ambition = $request->ambition;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->distance = $request->distance;
        $student->time = $request->time;
        $student->father = $request->father;
        $student->father_birth_place = $request->father_birth_place;
        $student->father_birth_date = $request->father_birth_date;
        $student->father_education = $request->father_education;
        $student->father_note = $request->father_note;
        $student->mother = $request->mother;
        $student->mother_birth_place = $request->mother_birth_place;
        $student->mother_birth_date = $request->mother_birth_date;
        $student->mother_education = $request->mother_education;
        $student->mother_note = $request->mother_note;
        $student->job = $request->job;
        $student->income = $request->income;
        $student->phone = $request->phone;
        $student->guardian = $request->guardian;
        $student->guardian_relationship = $request->guardian_relationship;
        $student->guardian_phone = $request->guardian_phone;
        $student->illness = $request->illness;
        $student->performance = $request->performance;
        $student->photo = $request->photo;
        $student->graduation = $request->graduation;
        $student->next_school = $request->next_school;
        $student->next_school_address = $request->next_school_address;
        $student->last_activity = $request->last_activity;
        $student->save();

        return response()->json([
            'data' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        $student->delete();
        return response()->json([
            'message' => 'Data Student dihapus!'
        ], 204);
    }
}
