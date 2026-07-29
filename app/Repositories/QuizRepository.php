<?php
namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use PhpParser\Node\Stmt\TryCatch;

class QuizRepository implements BaseRepositoryInterface {


    public function index(){

        $quizzes = Quiz::get();
        return view('pages.quizzes.index', compact('quizzes'));

    }
    public function create(){

        $data['subjects']=Subject::get();
        $data['teachers']=Teacher::all();
        $data['grades']=Grade::all();
       
        return view('pages.quizzes.create', $data);

    }

    public function store($request){

        Quiz::create([
            'title'=>['en'=>$request->title_en,'ar'=>$request->title_ar],
            'subject_id'=>$request->subject_id,
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->grade_id,
            'class_id'=>$request->class_id,
            'section_id'=>$request->section_id,
        ]);

        toastr()->success(trans('messages_trans.success'));
        return redirect()->route('quizzes.index');

    }

    public function update($request){

        Quiz::update([
            'title'=>$request->title,
            'subject_id'=>$request->subject_id,
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->grade_id,
            'class_id'=>$request->class_id,
            'section_id'=>$request->section_id,
        ]);

        toastr()->success(trans('messages_trans.update'));
        return redirect()->route('quizzes.index');

    }
    public function show($id){

    }
    public function edit($id){

        $date['quiz']=Quiz::findorfail('id',$id)->get();
        $data['subjects']=Subject::all();
        $data['teachers']=Teacher::all();
        $data['grades']=Grade::all();
        

        return view('pages.quizzes.edit', compact('data'));

    }
    public function destroy($request){

        try {

            Quiz::destroy($request->id);
            toastr()->error(trans('messages_trans.delete'));
            return redirect()->route('quizzes.index');

        } catch (\Exception $e) {
            
        }
    }

}