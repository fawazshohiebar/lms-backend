<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresectionsRequest;
use App\Http\Requests\UpdatesectionsRequest;
use App\Models\sections;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $class_id)
    {

        $sections = Sections::where('Class_ID', $class_id)->get();
        $sectionData = $sections->map(function ($sections) {
            return [
                'id' => $sections->id,
                'Section_Name' => $sections->Section_Name,
                'Class_ID' => $sections->Class_ID, 
                'User_ID' => $sections->User_ID, 
            ];
        });
        return $sectionData;
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
     * @param  \App\Http\Requests\StoresectionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresectionsRequest $request)
    {
        $sections = new sections();
        $sections->Section_Name=$request->input('Section_Name');
        $sections->Class_ID=$request->input('Class_ID');
        $sections->User_ID=$request->input('User_ID');
        $sections->save();
        return response()->json(['message' => 'sections created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }



    public function sectiongetter($class_id)
    {
        $sections = Sections::where('Class_ID', $class_id)->get();
        $sectionData = $sections->map(function ($section) {
            return [
                'id' => $section->id,
                'Section_Name' => $section->Section_Name,
                'Class_ID' => $section->Class_ID, 
                'User_ID' => $section->User_ID, 
            ];
        });
        return $sectionData;
    }











    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesectionsRequest  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesectionsRequest $request, sections $sections,$id)
    {
        $sections = sections::find($id);
        if (!$sections) {
            return response()->json(['message' => 'sect$sections not found'], 404);
        }
        $sections->Section_Name = $request->has('Section_Name')? $request->input('Section_Name'):$sections->Section_Name;
        // $sections->Class_ID = $request->has('Class_ID')?$request->input('Class_ID'):$sections->Class_ID;
        // $sections->Admin_ID = $request->has('Admin_ID')?$request->input('Admin_ID'):$sections->Admin_ID;
        $sections->save();
        return response()->json(['message' => 'sections updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(sections $sections, $id)
    {
        //
        $sections = sections::find($id);
        $sections->delete();
        return "the id have been deleted ";
    }


    public function search( $class)
    {
        
        return  sections::where('name','like','%'.$class.'%')->get();
    }
}
