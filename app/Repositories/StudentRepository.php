<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Attachment;
use App\Models\Grade;
use App\Models\Section;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\TheParents;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Interfaces\StudentRepositoryInterface;
use App\Traits\HandlingAttachmentsTrait;

class StudentRepository implements StudentRepositoryInterface
{

    use HandlingAttachmentsTrait;

    public function getStudents()
    {

        $students = Student::with(['grade', 'class', 'section', 'gender'])->paginate(10);
        return view('pages.students.students', compact('students'));
    }

    // ------------------------------------------------------------------------

    public function showStudent($id)
    {

        $student = Student::findorfail($id);

        return view('pages.students.show', compact('student'));
    }

    // ------------------------------------------------------------------------    
    public function upload_attachments($request)
    {


        $student = Student::findOrFail($request->student_id);
        $directory = $this->getDirectory($student);
        $files = $request->file('attachments');

        $this->uploadAttachments($files, $student, $directory);

        toastr()->success(trans('messages_trans.success'));
        return redirect()->route('students.show', $request->student_id);
    }
    // ------------------------------------------------------------------------  


    public function download_attachments($attachmentID)
    {
        $attachment = Attachment::findOrFail($attachmentID);
        return $this->downloadAttachment($attachment);
    }

    // ------------------------------------------------------------------------  

    public function delete_attachments($request)
    {

        $attachment = Attachment::findorfail($request->attachment_id);
        $this->deleteAttachment($attachment);

        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('students.show', $request->student_id);
    }

    // ------------------------------------------------------------------------
    public function getClasses($id)
    {
        return Classroom::where('grade_id', $id)->pluck('name', 'id');
    }

    // ------------------------------------------------------------------------
    public function getSections($id)
    {

        return Section::where('class_id', $id)->pluck('name', 'id');
    }


    // ------------------------------------------------------------------------
    public function createStudents()
    {
        $data['grades'] = Grade::all();
        $data['genders'] = Gender::all();
        $data['blood_types'] = BloodType::all();
        $data['nationalities'] = Nationality::all();
        $data['parents'] = TheParents::all();
        return view('pages.students.create', $data);
    }

    public function editStudents($id)
    {
        $data['student'] = Student::findorfail($id);
        $data['grades'] = Grade::all();
        $data['genders'] = Gender::all();
        $data['blood_types'] = BloodType::all();
        $data['nationalities'] = Nationality::all();
        $data['parents'] = TheParents::all();
        return view('pages.students.edit', $data);
    }

    // ------------------------------------------------------------------------
    public function storeStudents($request)
    {
        try {

            DB::beginTransaction();

            $student = new Student();
            $student->name = ['en' => $request->student_name_en, 'ar' => $request->student_name_ar];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->gender_id = $request->gender_id;
            $student->nationality_id = $request->nationality_id;
            $student->birth_date = $request->birth_date;
            $student->blood_type_id = $request->blood_type_id;
            $student->grade_id = $request->grade_id;
            $student->class_id = $request->class_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();

            if ($request->hasFile('photos')) {

                $directory = $this->getDirectory($student);
                $files = $request->file('photos');

                $this->uploadAttachments($files, $student, $directory);
            }

            DB::commit();
            toastr()->success(trans('messages_trans.success'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Student Creation Error: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // ------------------------------------------------------------------------
    public function updateStudents($request)
    {
        try {

            $student = Student::findOrfail($request->id);
            $student->name = ['en' => $request->student_name_en, 'ar' => $request->student_name_ar];
            $student->email = $request->email;
            if ($request->filled('password')) {
                $student->password = Hash::make($request->password);
            }
            $student->gender_id = $request->gender_id;
            $student->nationality_id = $request->nationality_id;
            $student->birth_date = $request->birth_date;
            $student->blood_type_id = $request->blood_type_id;
            $student->section_id = $request->section_id;
            $student->class_id = $request->class_id;
            $student->grade_id = $request->grade_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();

            toastr()->success(trans('messages_trans.update'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    // ------------------------------------------------------------------------
    public function deleteStudents($id)
    {
        $student = Student::findOrFail($id);
        $this->deleteModelAttachments($student);
        $student->forceDelete();

        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('students.index');
    }
}
