<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->query('year');
        $semester = $request->query('semester');

        $scores = Score::select('serial', 'registered', 'semester', 'competence_id', 'subject', DB::raw('MAX(created_at) as created_at'))
            ->selectRaw('COUNT(competence_id) AS count')
            ->groupBy('serial', 'registered', 'semester', 'competence_id', 'subject');

        if ($year && $semester) {
            $scores = $scores->where('registered', $year)->where('semester', $semester)->get();
        }else{
            $scores = $scores->get();
        }

        return view('assess.score', [
            'title' => 'Data Nilai',
            'rekap' => $scores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assess.create', [
            'title' => 'Data Nilai'
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
        $id = $request->input('id');
        $serial = $request->input('serial');
        $student_id = $request->input('student_id');
        $student = $request->input('student');
        $registered = $request->input('registered');
        $semester = $request->input('semester');
        $competence_id = $request->input('competence_id');
        $subject = $request->input('subject');
        $month_1 = $request->input('month_1');
        $month_2 = $request->input('month_2');
        $month_3 = $request->input('month_3');
        $month_4 = $request->input('month_4');
        $month_5 = $request->input('month_5');
        $month_6 = $request->input('month_6');
        $is_ok_1 = $request->input('is_ok_1');
        $competence_1 = $request->input('competence_1');
        $is_ok_2 = $request->input('is_ok_2');
        $competence_2 = $request->input('competence_2');
        $is_ok_3 = $request->input('is_ok_3');
        $competence_3 = $request->input('competence_3');

        foreach ($student_id as $key => $item) {
            $data = [
                'serial' => $serial,
                'student_id' => $student_id[$key],
                'student' => $student[$key],
                'registered' => $registered,
                'semester' => $semester,
                'competence_id' => $competence_id,
                'subject' => $subject,
                'month_1' => $month_1[$key],
                'month_2' => $month_2[$key],
                'month_3' => $month_3[$key],
                'month_4' => $month_4[$key],
                'month_5' => $month_5[$key],
                'month_6' => $month_6[$key],
                'is_ok_1' => isset($is_ok_1[$key]) ? $is_ok_1[$key] : 0,
                'competence_1' => $competence_1[$key],
                'is_ok_2' => isset($is_ok_2[$key]) ? $is_ok_2[$key] : 0,
                'competence_2' => $competence_2[$key],
                'is_ok_3' => isset($is_ok_3[$key]) ? $is_ok_3[$key] : 0,
                'competence_3' => $competence_3[$key],
            ];

            if ($id[$key] == 0) {
                $saved = Score::create($data);
            } else {
                $score = Score::find($id[$key]);
                $saved = $score->update($data);
            }
        };

        if ($saved) {
            return redirect('/data/nilai/' . $serial . '/edit')->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit($serial)
    {
        $scores = Score::where('serial', $serial)->get();
        if ($scores->isEmpty()) {
            return redirect()->action([self::class, 'index']);
        }
        return view('assess.edit', [
            'title' => 'Data Nilai',
            'scores' => $scores
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Score::destroy($id);
        if ($deleted) {
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('danger', 'Data gagal dihapus');
        }
    }

    public function rapor(Request $request)
    {
        $rapor = Score::select('student_id', 'semester')
            ->distinct()
            ->get();

        return view('assess.rapor', [
            'title' => 'Data Rapor',
            'students' => Student::orderBy('registered')->get(),
            'rapors' => $rapor
        ]);
    }

    public function rapor_view($semester, $ids)
    {
        $scores = Score::where('student_id', $ids)->where('scores.semester', $semester)
            ->select('scores.*', 'competences.subject_id', 'subjects.number')
            ->join('competences', 'competences.id', '=', 'scores.competence_id')
            ->join('subjects', 'subjects.id', '=', 'competences.subject_id')
            ->orderBy('subjects.number')
            ->get();

        // dd($scores);

        return view('assess.rapor_view', [
            'title' => 'Data Rapor',
            'semester' => $semester,
            'school' => School::first(),
            'student' => Student::find($ids),
            'scores' => $scores
        ]);
    }
}
