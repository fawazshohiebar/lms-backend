<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Models\student;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = $request->query();

        $initialQuery = Student::query()
            ->join('sections', 'sections.id', '=', 'students.Section_ID')
            ->join('classes', 'classes.id', '=', 'sections.Class_ID')
            ->select('students.id', 'students.First_Name', 'students.Last_Name', 'students.phone_number', 'students.image_path', 'students.Section_ID', 'sections.Section_Name', 'sections.Class_ID', 'classes.Class_Name');

        if (array_key_exists('section_id', $query) && $query['section_id']) {
            $initialQuery->where('students.Section_ID', $query['section_id']);
        }

        if (array_key_exists('class_id', $query) && $query['class_id']) {
            $initialQuery->where('sections.Class_ID', $query['class_id']);
        }

        return response()->json($initialQuery->get());
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

        return  student::where('First_Name', 'like', '%' . $name . '%')->get();
    }


    public function studentsgetter($Section_id)
    {
        $students = student::where('Section_ID', $Section_id)->get();
        $studentsData = $students->map(function ($stu) {
            return [
                'id' => $stu->id,
                'First_Name' => $stu->First_Name,
                'Last_Name' => $stu->Last_Name,
                'phone_number' => $stu->phone_number,
            ];
        });
        return $studentsData;
    }



    public function studentprofile($student_id)
    {
        $students = student::where('id', $student_id)->get();
        $studentsData = $students->map(function ($stu) {
            return [
                'id' => $stu->id,
                'First_Name' => $stu->First_Name,
                'Last_Name' => $stu->Last_Name,
                'phone_number' => $stu->phone_number,
            ];
        });
        return $studentsData;
    }











    // public function searches(Request $request)
    // {
    //     $query = $request->query();


    //     $initialQuery = student::with('students.Section_ID');

    //     if (array_key_exists('student_id', $query) && $query['student_id']) {
    //         $initialQuery->where('Students_ID', $query['student_id']);
    //     }

    //     if (array_key_exists('section_id', $query) && $query['section_id']) {
    //         $initialQuery->whereHas('student', function ($q) use ($query) {
    //             $q->where('Section_ID', $query['section_id']);
    //         });
    //     }
    //     if (array_key_exists('class_id', $query) && $query['class_id']) {
    //         $initialQuery->whereHas('student', function ($q) use ($query) {
    //             $q->whereHas('sections', function ($q2) use ($query) {
    //                 $q2->where('Class_ID', $query['class_id']);
    //             });
    //         });
    //     }


    //     $attendances = $initialQuery->get();

    //     $attendanceData = $attendances->map(function ($attendance) {
    //         return [
    //             'id' => $attendance->id,
    //             'student_name' => $attendance->student->First_Name . ' ' . $attendance->student->Last_Name,
    //             'section_name' => $attendance->student->sections->Section_Name,
    //             'class_name' => $attendance->student->sections->classes->Class_Name
    //         ];
    //     });
    //     return response()->json($attendanceData);
    // }






    // public function searches(Request $request)
    // {
    //     $classId = $request->input('class_id');
    //     $sectionId = $request->input('section_id');

    //     $students = Student::where('Class_ID', $classId)
    //                 ->where('Section_ID', $sectionId)
    //                 ->get();

    //     return response()->json($students);
    // }





    // public function joinn()
    // {
    //     $results = DB::table('classes')
    //                 ->join('sections', 'classes.id', '=', 'sections.Class_ID')
    //                 ->join('students', 'sections.id', '=', 'students.Section_ID')
    //                 ->select('classes.Class_Name', 'sections.Section_Name', 'students.First_Name', 'students.Last_Name')
    //                 ->get();

    //     return view('my_view', ['results' => $results]);
    // }


    // public function searches()
    // {

    //     $data = DB::table('students')
    //         ->join('sections', 'students.Section_ID', '=', 'sections.id')
    //         ->join('classes', 'sections.Class_ID', '=', 'classes.id')
    //         ->select('students.*', 'sections.Section_Name', 'classes.Class_Name')
    //         ->get();
    //     return response()->json([

    //         'data' => $data,
    //     ]);
    // }



    public function studensearch($id)
    {
        $data = DB::table('students')
            ->join('sections', 'students.Section_ID', '=', 'sections.id')
            ->join('classes', 'sections.Class_ID', '=', 'classes.id')
            ->select('students.*', 'sections.Section_Name', 'classes.Class_Name')
            ->where('students.id', $id)
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }












    public function studentsearchbysection($id)
    {
        $data = DB::table('students')
            ->join('sections', 'students.Section_ID', '=', 'sections.id')
            ->join('classes', 'sections.Class_ID', '=', 'classes.id')
            ->select('students.*', 'sections.Section_Name', 'classes.Class_Name')
            ->where('sections.id', $id)
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
