<?php

namespace App\Repositories;

use App\Interfaces\GraduationRepositoryInterface;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;

class GraduationRepository implements GraduationRepositoryInterface

{

    public function index()
    {
        $graduated_students = Student::onlyTrashed()->get();
        return view('pages.students.graduations.index', compact('graduated_students'));
    }
    public function create()
    {
        $grades = Grade::all();
        return view('pages.students.graduations.make', compact('grades'));
    }

    // this function to store the gardutaion
    public function soft_delete($request)
    {
        if ($request->graduation_type == 1) {
            $students = Student::where('grade_id', $request->grade_id)->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)->get();

            if ($students->isEmpty()) {
                return redirect()->back()->withErrors(['error' => trans('student_trans.no_data')]);
            }
            foreach ($students as $student) {
                Student::where('id', $student->id)->delete();
            }
        }

        toastr()->success(trans('messages_trans.success'));
        return redirect()->back();
    }


    public function rollback_of_graduation($request)
    {

        Student::onlyTrashed()->where('id', $request->id)->first()->restore();

        toastr()->success(trans('messages_trans.success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->forceDelete();
        
        toastr()->success(trans('messages_trans.success'));
        return redirect()->back();
    }
}