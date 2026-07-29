<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachersRequest;
use App\Interfaces\TeacherRepositoryInterface;



class TeacherController extends Controller
{
    protected $teacher_object;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher_object = $teacher;
    }


    public function index() {


        $teachers= $this->teacher_object->getAllTeachers();
         
         return view('pages.teachers.teachers',compact('teachers'));
    }

    
    public function create()
    {
        $genders= $this->teacher_object->getGenders();
        $specializations= $this->teacher_object->getSpecializations();
        return view('pages.teachers.create',compact('genders','specializations'));
    }
    
    
    public function store(StoreTeachersRequest $request)
    {
        return  $this->teacher_object->storeTeachers($request);
        
    }

    
    public function show($id)
    {
        //
    }

    
    

    public function edit($id)
    {   
        $teacher= $this->teacher_object->editTeachers($id);
        $genders= $this->teacher_object->getGenders();
        $specializations= $this->teacher_object->getSpecializations();

        return view('pages.teachers.edit',compact('teacher','specializations','genders'));
    }

    

    public function update(StoreTeachersRequest $request)
    {
        return $this->teacher_object->updateTeachers($request);
    }

    

    public function destroy(Request $request)
    {
        return $this->teacher_object->deleteTeachers($request);
    }
}