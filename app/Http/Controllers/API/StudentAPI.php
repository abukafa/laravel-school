<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentAPI extends Controller
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
            'address' => $request->address,
            'hamlet' => $request->hamlet,
            'village' => $request->village,
            'district' => $request->district,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'hobby' => $request->hobby,
            'sport' => $request->sport,
            'ambition' => $request->ambition,
            'role' => $request->role,
            'skills' => $request->skills,
            'own_phone' => $request->own_phone,
            'email' => $request->email,
            'password' => $request->password,
            'instagram' => $request->instagram,
            'father' => $request->father,
            'father_birth' => $request->father_birth,
            'father_note' => $request->father_note,
            'mother' => $request->mother,
            'mother_birth' => $request->mother_birth,
            'mother_note' => $request->mother_note,
            'phone' => $request->phone,
            'job' => $request->job,
            'income' => $request->income,
            'image' => $request->image,
            'payment_category' => $request->payment_category,
            'registered' => $request->registered,
            'graduation' => $request->graduation,
            'next_school' => $request->next_school,
            'next_school_address' => $request->next_school_address,
            'note' => $request->note
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->nick_name = $request->nick_name;
        $student->gender = $request->gender;
        $student->rumble = $request->rumble;
        $student->birth_place = $request->birth_place;
        $student->birth_date = $request->birth_date;
        $student->address = $request->address;
        $student->hamlet = $request->hamlet;
        $student->village = $request->village;
        $student->district = $request->district;
        $student->city = $request->city;
        $student->postal_code = $request->postal_code;
        $student->hobby = $request->hobby;
        $student->sport = $request->sport;
        $student->ambition = $request->ambition;
        $student->role = $request->role;
        $student->skills = $request->skills;
        $student->own_phone = $request->own_phone;
        $student->email = $request->email;
        $student->password = $request->password;
        $student->instagram = $request->instagram;
        $student->father = $request->father;
        $student->father_birth = $request->father_birth;
        $student->father_note = $request->father_note;
        $student->mother = $request->mother;
        $student->mother_birth = $request->mother_birth;
        $student->mother_note = $request->mother_note;
        $student->phone = $request->phone;
        $student->job = $request->job;
        $student->income = $request->income;
        $student->image = $request->image;
        $student->payment_category = $request->payment_category;
        $student->registered = $request->registered;
        $student->graduation = $request->graduation;
        $student->next_school = $request->next_school;
        $student->next_school_address = $request->next_school_address;
        $student->note = $request->note;
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
