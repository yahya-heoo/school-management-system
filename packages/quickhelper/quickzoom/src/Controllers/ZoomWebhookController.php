<?php
namespace QuickZoom\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use QuickZoom\Events\ZoomMeetingStarted;
use QuickZoom\Events\ZoomMeetingEnded;
use QuickZoom\Events\ZoomParticipantJoined;
use QuickZoom\Events\ZoomParticipantLeft;

class ZoomWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Verify webhook signature if secret is configured
        if (config('quickzoom.webhook_secret')) {
            $signature = $request->header('authorization');
            $expectedSignature = hash_hmac('sha256', $request->getContent(), config('quickzoom.webhook_secret'));
            
            if (!hash_equals($expectedSignature, $signature)) {
                Log::warning('Invalid Zoom webhook signature');
                return response()->json(['error' => 'Invalid signature'], 401);
            }
        }

        $payload = $request->all();
        $event = $payload['event'] ?? null;

        Log::info('Zoom webhook received', ['event' => $event, 'payload' => $payload]);

        try {
            switch ($event) {
                case 'meeting.started':
                    event(new ZoomMeetingStarted($payload));
                    break;
                    
                case 'meeting.ended':
                    event(new ZoomMeetingEnded($payload));
                    break;
                    
                case 'meeting.participant_joined':
                    event(new ZoomParticipantJoined($payload));
                    break;
                    
                case 'meeting.participant_left':
                    event(new ZoomParticipantLeft($payload));
                    break;
                    
                default:
                    Log::info('Unhandled Zoom webhook event', ['event' => $event]);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error processing Zoom webhook', [
                'event' => $event,
                'error' => $e->getMessage(),
                'payload' => $payload
            ]);
            
            return response()->json(['error' => 'Processing failed'], 500);
        }
    }
}