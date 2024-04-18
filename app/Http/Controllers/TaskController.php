<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use App\Models\Task;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.task', [
            'title' => 'Data Task',
            'tasks' => Task::all(),
            'projects' => Project::all(),
            'teachers' => Teacher::all(),
            'students' => Student::where('graduation', null)->get()
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
        $data = $request->all();
        $saved = Task::create($data);
        if($saved){
            return back()->with('success', 'Data berhasil disimpan');
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
        $task = Task::find($id);
        return response()->json([
            'task' => $task
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
        //
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
        $task = Task::find($id);
        $updated = $task->update($request->all());
        if($updated){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    public function acc(Request $request, $id)
    {
        $task = Task::find($id);
        $updated = $task->update($request->all());
        if($updated){
            return back()->with('success', 'Data berhasil disimpan');
        }else{
            return back()->with('danger', 'Data gagal disimpan');
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
        //
    }
}
