<?php

namespace App\Http\Controllers\Sections;

use App\Models\Section;
use App\Models\Classroom;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $classrooms = Classroom::with(['sections.teachers'])->get();
        $teachers = Teacher::all();

        return view('pages.sections.sections', compact('classrooms', 'teachers'));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        if (Section::where('class_id', $request->Class_id)->where(function ($query) use ($request) {
            $query->where('name->en', $request->Name_Section_En)->orWhere('name->ar', $request->Name_Section_Ar);
        })->exists()) {
            return redirect()->back()->withErrors(trans('grades_trans.exists'));
        }
        try {


            $sections = new Section();
            $sections->name = ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar];
            $sections->class_id = $request->Class_id;
            $sections->save();
            $sections->teachers()->attach($request->teacher_id);

            toastr()->success(trans('messages_trans.success'));

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    
    public function show(Section $section)
    {
        //
    }

   
    public function edit(Section $section)
    {
        //
    }

    public function update(Request $request)
    {

        try {

            $section = Section::findOrfail($request->id);
            $section->name = ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar];
            $section->status = ($request->Status == "on" ? 1 : 0);
            $section->class_id = $request->Class_id;
            $teacherIds = $request->input('teacher_id', []);
            $section->teachers()->sync($teacherIds);
            $section->save();

            toastr()->success(trans('messages_trans.update'));
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::where('id', $request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('sections.index');
    }
}
