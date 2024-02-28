<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $semester = $request->query('semester');
        if ($semester) {
            $competences = Competence::where('semester', $semester)->get();
        }else{
            $competences = Competence::all();
        }
        return view('assess.competence', [
            'title' => 'Data Kompetensi',
            'competences' => $competences,
            'subjects' => Subject::all(),
            'teachers' => Teacher::all()
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
        $data = $request->all();
        $saved = Competence::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $competence = Competence::find($id);
        return response()->json([
            'competence' => $competence
        ]);
    }

    public function findBySemester($smt)
    {
        $competence = Competence::where('semester', $smt)->get();
        return response()->json([
            'competences' => $competence
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, competence $competence, $id)
    {
        $competence = Competence::find($id);
        $data = $request->all();
        $updated = $competence->update($data);
        if($updated){
            return back()->with('success', 'Data berhasil diperbarui');
        }else{
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Competence::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
}
