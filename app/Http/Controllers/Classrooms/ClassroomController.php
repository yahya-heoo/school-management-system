<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    
    public function index()
    {   
        $classrooms=Classroom::with('grade')->get();
        $Grades=Grade::all();
        return view('pages.classrooms.classrooms',compact('classrooms','Grades'));
    }

   
    public function create()
    {
        
    }

   
    public function store(Request $request)
    {
        $List_Classes=$request->List_Classes;
        try{

            foreach ($List_Classes as $class){
                $classrooms= new Classroom();
                $classrooms->name =[ 'en'=>$class['className_en'],
                                     'ar'=>$class['className_ar'] 
                                   ];
                $classrooms->grade_id = $class['Grade_id'];
                $classrooms->save();
            }
            toastr()->success(trans('messages_trans.success'));
            return redirect()->route('classrooms.index');

        }catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Classroom $classroom)
    {
        //
    }

    public function edit(Classroom $classroom)
    {
        //
    }


    public function update(Request $request)
    {
        try {
            
            $classroom=Classroom::findOrfail($request->id);

            $classroom->update([
                $classroom->name= ['en'=>$request->className_en,'ar'=>$request->className_ar],
                $classroom->grade_id = $request->Grade_id,
            ]);
            
            toastr()->success(trans('messages_trans.update'));
            
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }
    }


    public function destroy(Request $request)
    {
        Classroom::findOrfail($request->id)->delete();

        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('classrooms.index');
    }

    public function delete_all(Request $request)
    {
        $classes=explode(",",$request->delete_all_id);
         
        Classroom::whereIn('id',$classes)->delete();

        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('classrooms.index');
    }
    public function filter_Classes(Request $request)
    {
        $Grades=Grade::all();
        $filterd=Classroom::where('grade_id','=',$request->Grade_id)->get();
      
        return view('pages.classrooms.classrooms',compact('Grades','filterd'));
    }
}