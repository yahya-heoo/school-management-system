<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Grade;
use App\Models\LibraryResource;
use App\Models\Teacher;
use App\Traits\HandlingAttachmentsTrait;
use Illuminate\Support\Facades\DB;

class LibraryRepository implements BaseRepositoryInterface
{
    use HandlingAttachmentsTrait;


    public function index()
    {
        $library_resources = LibraryResource::get();
        return view('pages.library-resources.index', compact('library_resources'));
    }

    public function show($id) {
        
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        
        return view('pages.library-resources.create', compact('grades', 'teachers'));
    }

    public function edit($id)
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        $library_resource = LibraryResource::findorfail($id);
        return view('pages.library-resources.edit', compact('grades', 'library_resource', 'teachers'));
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {

            $library_resource = new LibraryResource();
            $library_resource->title = $request->title;
            $library_resource->grade_id = $request->grade_id;
            $library_resource->class_id = $request->class_id;
            $library_resource->section_id = $request->section_id;
            $library_resource->teacher_id = 11; //$request->teacher_id;
            $library_resource->save();

            $files = $request->file('attachment');
            $directory = $this->getDirectory($library_resource);
            $this->uploadAttachments($files, $library_resource, $directory);

            DB::commit();
            toastr()->success(trans('messages_trans.success'));
            return redirect()->route('library-resources.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update($request)
    {
        
        DB::beginTransaction();
        try {
            

            $library_resource = LibraryResource::findorfail($request->id);
            $library_resource->title = $request->title;
            $library_resource->grade_id = $request->grade_id;
            $library_resource->class_id = $request->class_id;
            $library_resource->section_id = $request->section_id;
            $library_resource->save();
            


            if ($request->hasFile('attachment')) {
                $this->deleteModelAttachments($library_resource);
                $files = $request->file('attachment');
                $directory = $this->getDirectory($library_resource);
                $this->uploadAttachments($files, $library_resource, $directory);
            }

            DB::commit();
            toastr()->success(trans('messages_trans.update'));
            return redirect()->route('library-resources.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        $library_resource = LibraryResource::findorfail($request->id);
        $this->deleteModelAttachments($library_resource);
        $library_resource->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('library-resources.index');
    }
}