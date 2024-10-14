<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::select(
            "name",
            "subject",
            DB::raw("count(*) as count"),
            DB::raw("MIN(id) as first_id")
        )
            ->groupBy("name", "subject")
            ->get();

        return view("assess.course", [
            "title" => "Data Kursus",
            "courses" => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::distinct("group")->pluck("group");
        return view("assess.course_lesson", [
            "title" => "Data Kursus",
            "subjects" => $subjects,
            "items" => null,
            "item" => null,
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
        $saved = Course::create($data);

        if ($saved) {
            return redirect("data/kursus/{$saved->id}/edit")->with(
                "success",
                "Data berhasil disimpan"
            );
        } else {
            return back()->with("danger", "Data gagal disimpan");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Course::find($id);
        $items = Course::where("name", $item->name)->get();
        $subjects = Subject::distinct("group")->pluck("group");
        return view("assess.course_lesson", [
            "title" => "Data Kursus",
            "subjects" => $subjects,
            "items" => $items,
            "item" => null,
        ]);
    }

    public function editItem($id)
    {
        $item = Course::find($id);
        $items = $item ? Course::where("name", $item->name)->get() : null;
        $subjects = Subject::distinct("group")->pluck("group");
        return view("assess.course_lesson", [
            "title" => "Data Kursus",
            "subjects" => $subjects,
            "items" => $items,
            "item" => $item,
        ]);
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
        $course = Course::find($id);
        $data = $request->all();
        $updated = $course->update($data);
        if ($updated) {
            return back()->with("success", "Data berhasil diperbarui");
        } else {
            return back()->with("danger", "Data gagal diperbarui");
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
        $deleted = Course::destroy($id);
        if ($deleted) {
            return back()->with("success", "Data berhasil dihapus");
        } else {
            return back()->with("danger", "Data gagal dihapus");
        }
    }
}
