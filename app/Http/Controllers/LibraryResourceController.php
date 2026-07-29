<?php

namespace App\Http\Controllers;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Attachment;
use App\Traits\HandlingAttachmentsTrait;
use Illuminate\Http\Request;

class LibraryResourceController extends Controller
{
    use HandlingAttachmentsTrait;

    protected $library_obj;
    
    public function __construct(BaseRepositoryInterface $obj)
    {
        $this->library_obj = $obj;
    }
    
    public function index()
    {
        return $this->library_obj->index();
    }

    
    public function create()
    {
        return $this->library_obj->create();
    }

    
    public function store(Request $request)
    {
        return $this->library_obj->store($request);
    }

    
    public function show($id)
    {
        return $this->library_obj->show($id);
    }

    
    public function edit($id)
    {
        return $this->library_obj->edit($id);
    }

    
    public function update(Request $request)
    {
        return $this->library_obj->update($request);
    }

    
    public function download($resourceID)
    {
        $attachment = Attachment::where('attachmentable_id', $resourceID)->
                                  where('attachmentable_type','App\Models\LibraryResource')->first();
        return $this->downloadAttachment($attachment);
    }

    
    public function destroy(Request $request)
    {
        return $this->library_obj->destroy($request);
    }
}