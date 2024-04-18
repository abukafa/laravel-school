<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.plan', [
            'title' => 'Data Project',
            'projects' => Project::all(),
            'students' => Student::where('graduation', null)->get()
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
        Event::create([
            'title' => $request->theme,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'remark' => 'Project',
        ]);

        $data = $request->all();
        $saved = Project::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return response()->json([
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Data untuk Event
        $eventData = [
            'title' => $request->theme,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'remark' => 'Project',
        ];

        // Mencari Event berdasarkan description
        $event = Event::where('description', $request->description)->first();

        // Menggunakan transaksi database
        DB::beginTransaction();

        try {
            if ($event) {
                // Jika Event sudah ada, update data Event
                $event->update($eventData);
            } else {
                // Jika Event belum ada, buat Event baru
                Event::create($eventData);
            }

            // Update data Project
            $project = Project::find($id);
            $updated = $project->update($request->all());

            if ($updated) {
                DB::commit(); // Commit transaksi jika berhasil
                return back()->with('success', 'Data berhasil diperbarui');
            } else {
                throw new \Exception('Data gagal diperbarui');
            }
        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan
            return back()->with('danger', 'Data gagal diperbarui');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Project::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
}
