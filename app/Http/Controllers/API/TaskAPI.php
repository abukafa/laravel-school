<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TaskAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return response()->json([
            'data' => $tasks
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
        $tasks = Task::create([
            'project_id' => $request->project_id,
            'project_name' => $request->project_name,
            'student_id' => $request->student_id,
            'student_name' => $request->student_name,
            'semester' => $request->semester,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'link' => $request->link,
            'accepted' => $request->accepted,
            'review' => $request->review,
            'teacher_id' => $request->teacher_id,
            'teacher_name' => $request->teacher_name,
        ]);
        return response()->json([
            'data' => $tasks
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json([
            'data' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->project_id = $request->project_id;
        $task->project_name = $request->project_name;
        $task->student_id = $request->student_id;
        $task->student_name = $request->student_name;
        $task->semester = $request->semester;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->date = $request->date;
        $task->deadline = $request->deadline;
        $task->status = $request->status;
        $task->link = $request->link;
        $task->accepted = $request->accepted;
        $task->review = $request->review;
        $task->teacher_id = $request->teacher_id;
        $task->teacher_name = $request->teacher_name;
        $task->save();

        return response()->json([
            'data' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Data Task dihapus!'
        ], 204);
    }
}
