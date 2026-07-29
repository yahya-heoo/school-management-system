<?php

namespace App\Http\Controllers\Finances\Billing;

use App\Models\Refund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;

class RefundController extends Controller
{
    protected $refund_object;

    public function __construct(BaseRepositoryInterface $obj)
    {
        $this->refund_object = $obj;
    }
    
    public function index()
    {
        return $this->refund_object->index();
    }

    
    public function create()
    {
        return $this->refund_object->create();
    }

   
    public function store(Request $request)
    {
        return $this->refund_object->store($request);
    }

    
    public function show($id)
    {
       return $this->refund_object->show($id);
    }

    
    public function edit($id)
    {
        return $this->refund_object->edit($id);
    }

    
    public function update(Request $request)
    {
        return $this->refund_object->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->refund_object->destroy($request);
    }
}