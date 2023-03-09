<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecoursesRequest;
use App\Http\Requests\UpdatecoursesRequest;
use App\Models\courses;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = courses::all();
        $courseData = $course->map(function ($course) {
            return [
                'id' => $course->id,
                'Course_Name' => $course->Course_Name,
                'Section_ID' => $course->Section_ID,

            ];
        });
        return $course;
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
     * @param  \App\Http\Requests\StorecoursesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecoursesRequest $request)
    {
        $course = new courses();
        $course->Course_Name = $request->input('Course_Name');
        $course->Section_ID = $request->input('Section_ID');

        $course->save();
        return response()->json(['message' => 'course$course created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(courses $courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecoursesRequest  $request
     * @param  \App\Models\courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecoursesRequest $request, courses $courses, $id)
    {
        $courses = courses::find($id);
        if (!$courses) {
            return response()->json(['message' => 'courses not found'], 404);
        }
        $courses->Course_Name = $request->has('Course_Name') ? $request->input('Course_Name') : $courses->Course_Name;

        $courses->save();
        return response()->json(['message' => 'courses updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(courses $courses , $id)
    {
        $ana = courses::find($id);
        $ana->delete();
        return "the id have been deleted ";
    }
    public function search(courses $cname)
    {

        return  courses::where('Course_Name', 'like', '%' . $cname . '%')->get();
    }
}
