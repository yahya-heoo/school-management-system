<?php 
namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Fee;
use App\Models\Grade;

class FeeRepository implements BaseRepositoryInterface{

    public function index(){

        $fees = Fee::all();
        return view('pages.fees.index',compact('fees'));
    }

    public function create(){
        $grades = Grade::all();
        return view('pages.fees.create',compact('grades'));
    }

    public function store($request){

        $fee=new Fee();
        $fee->fee_type = [ 'en'=>$request->fee_type_en, 'ar'=>$request->fee_type_ar ];
        $fee->fee_amount=$request->amount;
        $fee->grade_id=$request->grade_id;
        $fee->class_id=$request->class_id;
        $fee->academic_year=$request->academic_year;
        $fee->fee_description=$request->description;
        $fee->save();

        toastr()->success(trans('messages_trans.success'));
        return redirect()->route('fees.index');

    }
    public function update($request){

        $fee=Fee::findorfail($request->id);

        $fee->fee_type = [ 'en'=>$request->fee_type_en, 'ar'=>$request->fee_type_ar ];
        $fee->fee_amount=$request->amount;
        $fee->grade_id=$request->grade_id;
        $fee->class_id=$request->class_id;
        $fee->academic_year=$request->academic_year;
        $fee->fee_description=$request->description;
        $fee->save();

        toastr()->success(trans('messages_trans.update'));
        return redirect()->route('fees.index');

    }
    public function edit($id){

        $fee=Fee::findorfail($id);
        $grades = Grade::all();
        return view('pages.fees.edit',compact('grades','fee'));

    }
    
    public function show($id){


    }


    public function destroy($request){

        Fee::findorfail($request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('fees.index');


    }

}