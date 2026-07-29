<?php

namespace App\Http\Controllers\Finances\Billing;

use App\Models\Fee;
use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class FeeController extends Controller
{   
    protected $fee_object;

    public function __construct(BaseRepositoryInterface $obj)
    {
        $this->fee_object = $obj; 
    }
    
    public function index()
    {
        return $this->fee_object->index();
    }

    
    public function create()
    {
        return $this->fee_object->create();
    
    }

    
    public function store(Request $request)
    {
        
        return $this->fee_object->store($request);
        
    }

    
    public function show(Fee $fee)
    {
        //
    }

    
    public function edit($id)
    {
        return $this->fee_object->edit($id);
    }

    
    public function update(Request $request)
    {
         return $this->fee_object->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->fee_object->destroy($request);
    }
}