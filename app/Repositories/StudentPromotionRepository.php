<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use App\Interfaces\StudentPromotionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface{

    public function index(){

        $promotions = Promotion::all();
        return view('pages.students.promotion.index',compact('promotions'));
    }

    public function create(){

        $grades = Grade::all();
        return view('pages.students.promotion.make',compact('grades'));
    }


    public function store($request){
        try {
            DB::beginTransaction();
    
            $students = Student::where('grade_id', $request->grade_id)
                               ->where('class_id', $request->class_id)
                               ->where('section_id', $request->section_id)
                               ->where('academic_year', $request->academic_year)
                               ->get();
    
            if ($students->isEmpty()) {
                return redirect()->back()->withErrors(['error' => trans('student_trans.no_data')]);
            }
    
           
            Student::where('grade_id', $request->grade_id)
                    ->where('class_id', $request->class_id)
                    ->where('section_id', $request->section_id)
                    ->where('academic_year', $request->academic_year)
                    ->update([
                        'grade_id' => $request->next_grade_id,
                        'class_id' => $request->next_class_id,
                        'section_id' => $request->next_section_id,
                        'academic_year' => $request->next_academic_year,
                    ]);
    
           
            foreach ($students as $student) {

                Promotion::updateOrCreate([
                    'student_id' => $student->id, 
                    'from_grade_id' => $request->grade_id,
                    'from_class_id' => $request->class_id,
                    'from_section_id' => $request->section_id,
                    'from_academic_year' => $request->academic_year,
                    'to_grade_id' => $request->next_grade_id,
                    'to_class_id' => $request->next_class_id,
                    'to_section_id' => $request->next_section_id,
                    'to_academic_year' => $request->next_academic_year,
                ]);
            }
    
            DB::commit();
            toastr()->success(trans('messages_trans.success'));
            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function destroy($request){

        try {
            DB::beginTransaction();

            if($request->rollback_type == 1) {

                    $promotions = Promotion::all();

                    foreach ($promotions as $promotion) {

                        Student::where('id', $promotion->student_id)
                                ->update([
                                    'grade_id' => $promotion->from_grade_id,
                                    'class_id' => $promotion->from_class_id,
                                    'section_id' => $promotion->from_section_id,
                                    'academic_year' => $promotion->from_academic_year,
                                ]); 
                    }
                    Promotion::truncate();
            }else{

                    $promotion = Promotion::findorfail($request->id);
                    
                    Student::where('id', $promotion->student_id)
                            ->update([
                                'grade_id' => $promotion->from_grade_id,
                                'class_id' => $promotion->from_class_id,
                                'section_id' => $promotion->from_section_id,
                                'academic_year' => $promotion->from_academic_year,
                            ]);

                    Promotion::destroy($request->id);
            }

            DB::commit();
                toastr()->success(trans('messages_trans.success'));
                return redirect()->back();

    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}