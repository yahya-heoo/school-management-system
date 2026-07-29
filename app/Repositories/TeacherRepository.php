<?php

namespace App\Repositories;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Interfaces\TeacherRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){

        return Teacher::all();
    }

    public function getGenders(){

        return Gender::all();
    }

    public function getSpecializations(){

        return Specialization::all();
    }

    public function storeTeachers($request){

        try {
            $teacher= new Teacher();
            $teacher->name = ['en'=> $request->teacher_name_en, 'ar'=> $request->teacher_name_ar];
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->gender_id = $request->gender_id;
            $teacher->specialization_id = $request->specialization_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();
            
            toastr()->success(trans('messages_trans.success'));
            return redirect()->route('teachers.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    
    public function editTeachers($id){
        
           return  Teacher::findOrfail($id);
    }

    //update Teacher infos
    public function updateTeachers($request){
        try {
            $teacher=Teacher::findOrfail($request->id);
            $teacher->name = ['en'=> $request->teacher_name_en, 'ar'=> $request->teacher_name_ar];
            $teacher->email = $request->email;
            if ($request->filled('password')) {
                $teacher->password = Hash::make($request->password);
            }
            $teacher->gender_id = $request->gender_id;
            $teacher->specialization_id = $request->specialization_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();
            
            toastr()->success(trans('messages_trans.update'));
            return redirect()->route('teachers.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
    
    public function deleteTeachers($request){

        Teacher::findOrfail($request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('teachers.index');


    }

    
}  