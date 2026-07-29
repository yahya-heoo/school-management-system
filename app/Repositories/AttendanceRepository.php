<?php


namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;

class AttendanceRepository implements BaseRepositoryInterface {

    public function index()
    {
        $Grades= Grade::all();
        return view('pages.attendance.index', compact('Grades'));
    }
    
    public function show($id)
    {
        $students =Student::with('attendances')->where('section_id',$id)->get();
        return view('pages.attendance.take', compact('students'));
    }
    
    public function create()
    {
        
    }
    public function edit($id)
    {
        
    }
    public function store($request)
    {
        foreach($request->attendances as $studentID => $status){
            Attendance::create([
                'student_id'=> $studentID,
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'teacher_id' => 11,
                'attendance_status' => $status =='presence' ? true : false,
                'attendance_date' => date('Y-m-d'),
            ]);
        }

        return redirect()->back();
    }
    public function update($request)
    {
        
    }
    public function destroy($request)
    {
        
    }
    
    
}


?>