<?php

namespace App\Http\Controllers\Students;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentPromotionRepositoryInterface;

class PromotionController extends Controller
{
    protected $promotion_object;


    public function __construct(StudentPromotionRepositoryInterface $promotion)
    {
        $this->promotion_object = $promotion;
        
    }
    
    public function index()
    {
        return $this->promotion_object->index();
    }

    
    public function create()
    {
        return $this->promotion_object->create();
    }

    
    public function store(Request $request)
    {
        return $this->promotion_object->store($request);
    }

    
    public function show(Promotion $promotion)
    {
        
    }

    
    public function edit(Promotion $promotion)
    {
        
    }

    
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    
    public function destroy(Request $request)
    {
        return $this->promotion_object->destroy($request);
    }
}