<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Models\student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = student::all();
        $studentData = $student->map(function($student){
            return [
                'id' => $student->id,
                'First_Name'=> $student->First_Name,
                'Last_Name'=>$student->Last_Name,
                'phone_number'=>$student->phone_number,
                'image_path'=>$student->image_path,
                'Section_ID'=>$student->Section_ID,
            ];
        });
            return $student;
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
     * @param  \App\Http\Requests\StorestudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorestudentRequest $request)
    {
        $student = new student();
        $student->First_Name = $request->input('First_Name');
        $student->Last_Name = $request->input('Last_Name');
        $student->phone_number = $request->input('phone_number');
    
        // handle file upload.
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $student->image_path = 'uploads/' . $filename;
        }
    
        $student->Section_ID = $request->input('Section_ID');
        $student->save();
        return response()->json(['message' => 'student entered successfully']);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestudentRequest  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestudentRequest $request, $id)
    {
        $student = student::find($id);
        if (!$student) {
            return response()->json(['message' => 'student not found'], 404);
        }
    
        $student->First_Name = $request->has('First_Name') ? $request->input('First_Name') : $student->First_Name;
        $student->Last_Name = $request->has('Last_Name') ? $request->input('Last_Name') : $student->Last_Name;
        $student->phone_number = $request->has('phone_number') ? $request->input('phone_number') : $student->phone_number;
    
        // handle file upload
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $student->image_path = 'uploads/' . $filename;
        } else {
            $student->image_path = $request->has('image_path') ? $request->input('image_path') : $student->image_path;
        }
    
        $student->Section_ID = $request->has('Section_ID') ? $request->input('Section_ID') : $student->Section_ID;
        $student->save();
        return response()->json(['message' => 'Student updated successfully'], 200);   
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $request, $id)
    {
        $ana = student::find($id);
        $ana->delete();
        return "the id have been deleted ";
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  str $First_Name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        
        return  student::where('First_Name','like','%'.$name.'%')->get();
    }
}

