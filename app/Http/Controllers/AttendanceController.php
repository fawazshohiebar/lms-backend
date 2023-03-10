<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use App\Models\attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attendance = Attendance::all();
        $attendanceData = $attendance->map(function($attendance){
            return [
                'id' => $attendance->id,
                'Date'=> $attendance->Date,
                'Status'=>$attendance->Status,
                'Students_ID'=>$attendance->Students_ID,
            ];
        });
            return $attendance;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreattendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreattendanceRequest $request)
    {
        $attendance = new attendance();
        $attendance->Date=$request->input('Date');
        $attendance->Status=$request->input('Status');
        $attendance->Students_ID=$request->input('Students_ID');
        $attendance->save();
        return response()->json(['message' =>'attendance entered successfully' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateattendanceRequest  $request
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateattendanceRequest $request, attendance $attendance,$id)
    {
        $attendance = attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'attendance not found'], 404);
        }
            $attendance->Date = $request->has('Date')? $request->input('Date'):$attendance->Date;
            $attendance->Status = $request->has('Status')?$request->input('Status'):$attendance->Status;
            $attendance->Students_ID = $request->has('Students_ID')?$request->input('Students_ID'):$attendance->Students_ID;

            $attendance->save();
            return response()->json(['message' => 'attendance updated successfully'], 200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendance $attendance, $id)
    {
        $ana = attendance::find($id);
        $ana->delete();
        return "the id have been deleted ";
    }
}
