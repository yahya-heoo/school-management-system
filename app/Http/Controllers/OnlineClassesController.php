<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\OnlineClasses;
use App\Traits\MeetingZoomTrait;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

use function PHPUnit\Framework\isTrue;

class OnlineClassesController extends Controller
{
    use MeetingZoomTrait;

    public function index()
    {
        $onlineClasses = OnlineClasses::get();
        return view('pages.online-classes.index', compact('onlineClasses'));
    }
    public function testZoomAuth()
    {
        $result = $this->testZoomAuthentication();
        return response()->json($result);
    }


    public function create(Request $request)
    {
        $grades = Grade::get();
        $integration = filter_var($request->integration, FILTER_VALIDATE_BOOLEAN);
        $view = $integration ? 'create-new-zoom' : 'create-existing-zoom';

        return view('pages.online-classes.' . $view, compact('grades'));
    }


    public function store(Request $request)
    {


        $meeting = $this->createMeeting($request);

        OnlineClasses::create([
            'integration' => true,
            'grade_id' => $request->grade_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting['id'],
            'topic' => $meeting['topic'],
            'duration' => $meeting['duration'],
            'password' => $meeting['password'],
            'start_time' => $meeting['start_time'],
            'start_url' => $meeting['start_url'],
            'join_url' => $meeting['join_url'],
        ]);

        toastr()->success('messages_trans.success');
        return redirect()->route('online-classes.index');



        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    public function storeExistingZoom(Request $request)
    {


        OnlineClasses::create([
            'integration' => false,
            'grade_id' => $request->grade_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);

        toastr()->success('messages_trans.success');
        return redirect()->route('online-classes.index');
    }




    public function show(OnlineClasses $onlineClasses) {}


    public function edit(OnlineClasses $onlineClasses) {}


    public function update(Request $request, OnlineClasses $onlineClasses) {}


    public function destroy(Request $request)
    {

        $this->deleteMeeting($request->id);

        OnlineClasses::where('meeting_id', $request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('onlineClasses.index');
    }
}