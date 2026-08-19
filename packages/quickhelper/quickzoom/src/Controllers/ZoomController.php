<?php
namespace QuickZoom\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use QuickZoom\Contracts\ZoomServiceInterface;

class ZoomController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomServiceInterface $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function index()
    {
        try {
            $meetings = $this->zoomService->listMeetings();
            return response()->json(['success' => true, 'data' => $meetings]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show($id)
    {
        try {
            $meeting = $this->zoomService->getMeeting($id);
            return response()->json(['success' => true, 'data' => $meeting]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string|max:200',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:15|max:300',
            'agenda' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $meeting = $this->zoomService->createMeeting('me', $request->all());
            return response()->json([
                'success' => true,
                'message' => 'Meeting created successfully',
                'data' => $meeting
            ], 201);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'sometimes|required|string|max:200',
            'start_time' => 'sometimes|required|date',
            'duration' => 'sometimes|required|integer|min:15|max:300',
            'agenda' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $meeting = $this->zoomService->updateMeeting($id, $request->all());
            return response()->json([
                'success' => true,
                'message' => 'Meeting updated successfully',
                'data' => $meeting
            ]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->zoomService->deleteMeeting($id);
            return response()->json([
                'success' => true,
                'message' => 'Meeting deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function endMeeting($id)
    {
        try {
            $result = $this->zoomService->endMeeting($id);
            return response()->json([
                'success' => true,
                'message' => 'Meeting ended successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function participants($id)
    {
        try {
            $participants = $this->zoomService->listParticipants($id);
            return response()->json(['success' => true, 'data' => $participants]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function recordings($id)
    {
        try {
            $recordings = $this->zoomService->listRecordings($id);
            return response()->json(['success' => true, 'data' => $recordings]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function registerParticipant(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:64',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $registration = $this->zoomService->registerParticipant($id, $request->all());
            return response()->json([
                'success' => true,
                'message' => 'Participant registered successfully',
                'data' => $registration
            ], 201);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    private function handleError(\Exception $e)
    {
        return response()->json([
            'success' => false,
            'message' => 'Zoom API Error',
            'error' => $e->getMessage()
        ], 500);
    }
}