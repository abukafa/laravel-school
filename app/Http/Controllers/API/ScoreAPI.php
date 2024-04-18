<?php

namespace App\Http\Controllers\API;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ScoreAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Score::paginate(10);
        return response()->json([
            'data' => $scores
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
        $scores = Score::create([
            'serial' => $request->serial,
            'student_id' => $request->student_id,
            'student' => $request->student,
            'registered' => $request->registered,
            'semester' => $request->semester,
            'competence_id' => $request->competence_id,
            'subject' => $request->subject,
            'month_1' => $request->month_1,
            'month_2' => $request->month_2,
            'month_3' => $request->month_3,
            'month_4' => $request->month_4,
            'month_5' => $request->month_5,
            'month_6' => $request->month_6,
            'is_ok_1' => $request->is_ok_1,
            'competence_1' => $request->competence_1,
            'is_ok_2' => $request->is_ok_2,
            'competence_2' => $request->competence_2,
            'is_ok_3' => $request->is_ok_3,
            'competence_3' => $request->competence_3,
        ]);
        return response()->json([
            'data' => $scores
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        return response()->json([
            'data' => $score
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        $score->serial = $request->serial;
        $score->student_id = $request->student_id;
        $score->student = $request->student;
        $score->registered = $request->registered;
        $score->semester = $request->semester;
        $score->competence_id = $request->competence_id;
        $score->subject = $request->subject;
        $score->month_1 = $request->month_1;
        $score->month_2 = $request->month_2;
        $score->month_3 = $request->month_3;
        $score->month_4 = $request->month_4;
        $score->month_5 = $request->month_5;
        $score->month_6 = $request->month_6;
        $score->is_ok_1 = $request->is_ok_1;
        $score->competence_1 = $request->competence_1;
        $score->is_ok_2 = $request->is_ok_2;
        $score->competence_2 = $request->competence_2;
        $score->is_ok_3 = $request->is_ok_3;
        $score->competence_3 = $request->competence_3;
        $score->save();

        return response()->json([
            'data' => $score
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        $score->delete();
        return response()->json([
            'message' => 'Data Score dihapus!'
        ], 204);
    }
}
