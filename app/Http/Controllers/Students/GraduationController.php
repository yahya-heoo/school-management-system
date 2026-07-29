<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Interfaces\GraduationRepositoryInterface;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    protected $graduation_object ;

    public function __construct(GraduationRepositoryInterface $graduation)
    {
        $this->graduation_object = $graduation;
    }

    public function index()
    {
       return $this->graduation_object->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->graduation_object->create();
    }

   
    public function store(Request $request)
    {
        return $this->graduation_object->soft_delete($request);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        return $this->graduation_object->rollback_of_graduation($request);
       
    }

    
    public function destroy($request)
    {
        return $this->graduation_object->destroy($request);
    }
}