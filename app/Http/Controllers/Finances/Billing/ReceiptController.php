<?php

namespace App\Http\Controllers\Finances\Billing;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;

class ReceiptController extends Controller
{
    
    protected $receipt_object;

    public function __construct(BaseRepositoryInterface $obj)
    {
        $this->receipt_object = $obj;
    }
    
    public function index()
    {
        return $this->receipt_object->index();
    }
    
    public function create()
    {
        return $this->receipt_object->create();
    }

    
    public function store(Request $request)
    {
        return $this->receipt_object->store($request);
    }

    public function show($id)
    {
        return $this->receipt_object->show($id);
    }

    
    public function edit($id)
    {
        return $this->receipt_object->edit($id);
    }

    
    public function update(Request $request)
    {
        return $this->receipt_object->update( $request);
    }

    
    public function destroy(Request $request)
    {
        return $this->receipt_object->destroy($request);
    }
}