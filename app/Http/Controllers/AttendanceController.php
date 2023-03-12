<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use App\Models\attendance;
<<<<<<< HEAD
use App\Models\student;
use Carbon\Carbon;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
=======
use Illuminate\Http\Request;

>>>>>>> origin/Fatima
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = $request->query();


        $initialQuery = Attendance::with('student.sections');

        if (array_key_exists('student_id', $query) && $query['student_id']) {
            $initialQuery->where('Students_ID', $query['student_id']);
        }

        if (array_key_exists('section_id', $query) && $query['section_id']) {
            $initialQuery->whereHas('student', function ($q) use ($query) {
                $q->where('Section_ID', $query['section_id']);
            });
        }
        if (array_key_exists('class_id', $query) && $query['class_id']) {
            $initialQuery->whereHas('student', function ($q) use ($query) {
                $q->whereHas('sections', function ($q2) use ($query) {
                    $q2->where('Class_ID', $query['class_id']);
                });
            });
        }
        if (array_key_exists('date', $query) && $query['date']) {
            $initialQuery->whereDate('Date', $query['date']);
        }

        $attendances = $initialQuery->get();

        $attendanceData = $attendances->map(function ($attendance) {
            return [
                'id' => $attendance->id,
                'date' => $attendance->Date,
                'status' => $attendance->Status,
                'student_name' => $attendance->student->First_Name . ' ' . $attendance->student->Last_Name,
                'section_name' => $attendance->student->sections->Section_Name,
                'class_name' => $attendance->student->sections->classes->Class_Name
            ];
        });
        return response()->json($attendanceData);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\x  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
<<<<<<< HEAD
        $attendanceData = $request->input('attendance');

        foreach ($attendanceData as $data) {
            // check if attendance record already exists for this student on this date
            $existingAttendance = Attendance::where('Students_ID', $data['studentId'])
                ->whereDate('Date', now()->format('Y-m-d'))
                ->first();

            if (!$existingAttendance) {
                // create new attendance record
                $attendance = new Attendance();
                $attendance->Date = now()->format('Y-m-d');
                $attendance->Status = $data['attendanceType'];
                $attendance->Students_ID = $data['studentId'];
                $attendance->save();
            }
        }

        return response()->json(['message' => 'Attendance entered successfully']);
=======
        $attendance = new attendance();
        $attendance->Date = $request->input('Date');
        $attendance->Status = $request->input('Status');
        $attendance->Students_ID = $request->input('Student_ID');
        $attendance->save();
        return response()->json(['message' => 'attendance entered successfully']);
>>>>>>> origin/Fatima
    }


    /**
     * 
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
<<<<<<< HEAD
    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json([
                'message' => 'Attendance not found',
            ], 404);
        }

        if ($request->has('Status')) {
            $attendance->Status = $request->input('Status');
        }

        $attendance->save();

        return response()->json([
            'message' => 'Attendance updated successfully',
            'attendance' => $attendance,
        ]);
=======
    public function update(UpdateattendanceRequest $request, attendance $attendance, $id)
    {
        $attendance = attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'attendance not found'], 404);
        }
        $attendance->Date = $request->has('Date') ? $request->input('Date') : $attendance->Date;
        $attendance->Status = $request->has('Status') ? $request->input('Status') : $attendance->Status;
        $attendance->Students_ID = $request->has('Students_ID') ? $request->input('Students_ID') : $attendance->Students_ID;

        $attendance->save();
        return response()->json(['message' => 'attendance updated successfully'], 200);
>>>>>>> origin/Fatima
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


    public function search($date)
    {
<<<<<<< HEAD
        $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        $attendances = Attendance::where('Date', $formattedDate)->get();

        return response()->json(['attendances' => $attendances]);
=======

        return  attendance::where('name', 'like', '%' . $Date . '%')->get();
    }

    public function barGraphRecords(attendance $Date)
    {

        return  attendance::where();
>>>>>>> origin/Fatima
    }
}
