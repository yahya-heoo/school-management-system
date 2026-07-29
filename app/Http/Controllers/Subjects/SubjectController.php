<?php

namespace App\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;

class SubjectController extends Controller
{
    protected $subject_object;

    public function __construct( BaseRepositoryInterface $subject)
    {
        $this->subject_object = $subject;
    }


    public function index()
    {
        return $this->subject_object->index();
    }


    public function create()
    {
        return $this->subject_object->create();
    }

   
    public function store(Request $request)
    {
        return $this->subject_object->store($request);
    }

    
    // public function show($id)
    // {
    //     return $this->subject_object->show($id);
    // }

 
    public function edit($id)
    {
        return $this->subject_object->edit($id);
    }


    public function update(Request $request)
    {
        return $this->subject_object->update($request);
    }

 
    public function destroy(Request $request)
    {
        return $this->subject_object->destroy($request);
    }
}
