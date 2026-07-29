<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGradesRequest;


class GradeController extends Controller
{
    
    public function index()
    {   $grades=Grade::all();
        return view('pages.grades.grades',compact('grades'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(StoreGradesRequest $request)
    {
        if(Grade::where('name->en',$request->Name_en)->orWhere('name->ar',$request->Name)->exists())
        {
            return redirect()->back()->withErrors(trans('grades_trans.exists'));
        }
        try {
            $validated = $request->validated();

            $grades=new Grade();
            $grades->name= ['en'=>$request->Name_en,'ar'=>$request->Name];
            $grades->notes = $request->Notes;
            $grades->save();

            toastr()->success(trans('messages_trans.success'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(StoreGradesRequest $request)
    {
        try {
            $validated = $request->validated();
            $grade=Grade::findOrfail($request->id);

            $grade->update([
                $grade->name= ['en'=>$request->Name_en,'ar'=>$request->Name],
                $grade->notes = $request->Notes,
            ]);
            
            toastr()->success(trans('messages_trans.update'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }
    }

    
    public function destroy(Request $request)
    {
        $classes = Classroom::where('grade_id',$request->id)->pluck('grade_id');

        if($classes->count() == 0) {
            $grade=Grade::findOrfail($request->id)->delete();

            toastr()->error(trans('messages_trans.delete'));
            return redirect()->route('grades.index');

        } else{
            toastr()->error(trans('grades_trans.delete_grade_error'));
            return redirect()->route('grades.index');

        }

        

        
    }
}