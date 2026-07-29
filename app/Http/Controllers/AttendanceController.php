<?php

namespace App\Http\Controllers;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    
    protected $attendance_object;
    
    public function __construct(BaseRepositoryInterface $obj)
    {
        $this->attendance_object = $obj;
    }
    
    public function index()
    {
        return $this->attendance_object->index();
    }

    
    public function create()
    {
        return $this->attendance_object->create();
    }

    
    public function store(Request $request)
    {
        return $this->attendance_object->store($request);
    }

    
    public function show($id)
    {
         return $this->attendance_object->show($id);
    }

    public function edit($id)
    {
         return $this->attendance_object->edit($id);
    }

    
    public function update(Request $request)
    {
         return $this->attendance_object->update($request);
    }

    
    public function destroy(Request $request)
    {
         return $this->attendance_object->destroy($request);
    }
}