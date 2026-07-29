<?php
namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Grade;
use App\Models\Specialization;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements BaseRepositoryInterface{

    public function index(){

        $subjects = Subject::with('teachers')->get();
        
        return view('pages.subjects.index',compact('subjects'));

    }

    public function show($id){

    }
    
    
    public function create(){

        $grades= Grade::all();
        $specializations=Specialization::with('teachers')->get();
        return view('pages.subjects.create',compact('grades','specializations'));

    }
    public function store($request){

        $subject= new Subject();
        $subject->specialization_id = $request->specialization_id;
        $subject->grade_id =  $request->grade_id;
        $subject->class_id =  $request->class_id;
        $subject->save();
        $subject->teachers()->attach($request->teacher_id);

        toastr()->success(trans('messages_trans.success'));
        return redirect()->route('subjects.index');

    }
    public function update($request){

        $subject = Subject::with('teachers')->findOrFail($request->id);
        $subject->specialization_id = $request->specialization_id;
        $subject->grade_id =  $request->grade_id;
        $subject->class_id =  $request->class_id;
        $subject->save();
        $subject->teachers()->sync($request->teacher_id);

        toastr()->success(trans('messages_trans.update'));
        return redirect()->route('subjects.index');

    }
    public function edit($id){

        $subject=Subject::findorfail($id);
        $grades= Grade::all();
        $teachers=Teacher::all();
        $specializations=Specialization::all();
        return view('pages.subjects.edit',compact('grades','teachers','subject','specializations'));


    }
    public function destroy($request){

        Subject::findorfail($request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('subjects.index');

    }


}