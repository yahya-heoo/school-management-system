<?php
namespace QuickZoom\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyZoomWebhook
{
    public function handle(Request $request, Closure $next)
    {
        $webhookSecret = config('quickzoom.webhook_secret');
        
        if (!$webhookSecret) {
            Log::warning('Zoom webhook secret not configured');
            return $next($request);
        }

        $signature = $request->header('authorization');
        $expectedSignature = hash_hmac('sha256', $request->getContent(), $webhookSecret);

        if (!hash_equals($expectedSignature, $signature)) {
            Log::warning('Invalid Zoom webhook signature', [
                'expected' => $expectedSignature,
                'received' => $signature
            ]);
            
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        return $next($request);
    }
}