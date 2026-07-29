<?php

namespace App\Http\Controllers\Quizzes;


use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $quiz_object;

    public function __construct(BaseRepositoryInterface $quiz)
    {
        $this->quiz_object= $quiz;
    }

    public function index()
    {
        return $this->quiz_object->index();
    }

    
    public function create()
    {
        return $this->quiz_object->create();
    }

    public function store(Request $request)
    {
        return $this->quiz_object->store($request);
    }

    
    public function show($id)
    {
        return $this->quiz_object->show($id);
    }

    
    public function edit($id)
    {
        return $this->quiz_object->edit($id);
    }

    
    public function update(Request $request)
    {
        return $this->quiz_object->update($request);
    }

  
    public function destroy(Request $request)
    {
        return $this->quiz_object->destroy($request);
    }
}