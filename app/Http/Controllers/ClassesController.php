<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclassesRequest;
use App\Http\Requests\UpdateclassesRequest;
use App\Models\classes;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classess = classes::all();
    
        
        return $classess;
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
     * @param  \App\Http\Requests\StoreclassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreclassesRequest $request)
    {
        $clas = new classes();
        $clas->Class_Name=$request->input('Class_Name');
      
        $clas->save();
        return response()->json(['message' => 'clas$clas created successfully'], 201);
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclassesRequest  $request
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateclassesRequest $request, classes $classes ,$id)
    {
        $clas = classes::find($id);
        if (!$clas) {
            return response()->json(['message' => 'clas not found'], 404);
        }
        $clas->Class_Name = $request->has('Class_Name')? $request->input('Class_Name'):$clas->Class_Name;
       
        $clas->save();
        return response()->json(['message' => 'clasess updated successfully'], 200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(classes $request,$id)
    {
        $ana = classes::find($id);
            $ana->delete();
            return "the id have been deleted ";
    }
}
