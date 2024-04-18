<?php

namespace App\Http\Controllers\API;

use App\Models\Competence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CompetenceAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competences = Competence::paginate(10);
        return response()->json([
            'data' => $competences
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
        $competences = Competence::create([
            'subject_id' => $request->subject_id,
            'subject' => $request->subject,
            'semester' => $request->semester,
            'teacher_id' => $request->teacher_id,
            'teacher' => $request->teacher,
            'competence_1' => $request->competence_1,
            'competence_2' => $request->competence_2,
            'competence_3' => $request->competence_3,
        ]);
        return response()->json([
            'data' => $competences
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function show(Competence $competence)
    {
        return response()->json([
            'data' => $competence
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competence $competence)
    {
        $competence->subject_id = $request->subject_id;
        $competence->subject = $request->subject;
        $competence->semester = $request->semester;
        $competence->teacher_id = $request->teacher_id;
        $competence->teacher = $request->teacher;
        $competence->competence_1 = $request->competence_1;
        $competence->competence_2 = $request->competence_2;
        $competence->competence_3 = $request->competence_3;
        $competence->save();

        return response()->json([
            'data' => $competence
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();
        return response()->json([
            'message' => 'Data Competence dihapus!'
        ], 204);
    }
}
