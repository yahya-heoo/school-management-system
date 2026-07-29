<?php

namespace App\Http\Controllers\Students;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $student_object;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student_object = $student;
    }

    public function getClasses($id)
    {
        return $this->student_object->getClasses($id);
    }

    public function getSections($id)
    {

        return $this->student_object->getSections($id);
    }

    public function index()
    {
        return $this->student_object->getStudents();
    }


    public function create()
    {
        return $this->student_object->createStudents();
    }


    public function store(Request $request)
    {
        return $this->student_object->storeStudents($request);
    }


    public function show($id)
    {
        return $this->student_object->showStudent($id);
    }


    public function edit($id)
    {
        return $this->student_object->editStudents($id);
    }


    public function update(Request $request)
    {
        return $this->student_object->updateStudents($request);
    }

    //    ==========================================================
    public function upload_attachments(Request $request)
    {
        return $this->student_object->upload_attachments($request);
    }
    public function delete_attachments(Request $request)
    {
        return $this->student_object->delete_attachments($request);
    }

    public function  download_attachments($attachmentID)
    {
        return $this->student_object->download_attachments($attachmentID);
    }


    public function destroy($id)
    {
        return $this->student_object->deleteStudents($id);
    }
}
