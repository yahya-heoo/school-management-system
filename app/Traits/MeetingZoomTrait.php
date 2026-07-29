<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Exception;

trait MeetingZoomTrait
{
    public function createMeeting($request)
    {
        try {
            // First, get access token using OAuth
            $accessToken = $this->getZoomAccessToken();

            // Create the meeting via Zoom API
            $meetingData = [
                'topic' => $request->topic,
                'type' => 2, // Scheduled meeting
                'start_time' => $this->formatZoomTime($request->start_time),
                'duration' => (int) $request->duration,
                'timezone' => config('app.timezone', 'UTC'),
                'password' => $request->password ?? $this->generateRandomPassword(),
                'settings' => [
                    'join_before_host' => true,
                    'host_video' => false,
                    'participant_video' => false,
                    'mute_upon_entry' => true,
                    'waiting_room' => false,
                    'audio' => 'both',
                    'auto_recording' => 'none'
                ]
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post('https://api.zoom.us/v2/users/me/meetings', $meetingData);

            if ($response->successful()) {
                return $response->json();
            } else {
                throw new Exception('Zoom API Error: ' . $response->body());
            }
        } catch (Exception $e) {
            throw new Exception('Failed to create Zoom meeting: ' . $e->getMessage());
        }
    }

    // Add this PUBLIC method to your MeetingZoomTrait
    public function testZoomAuthentication()
    {
        try {
            $accessToken = $this->getZoomAccessToken();
            return [
                'success' => true,
                'message' => 'Zoom authentication successful!',
                'token_type' => 'Bearer'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteMeeting($meetingId)
    {
        try {
            $accessToken = $this->getZoomAccessToken();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->delete("https://api.zoom.us/v2/meetings/{$meetingId}");

            if ($response->successful()) {
                return true;
            } else {
                throw new Exception('Zoom API Error: ' . $response->body());
            }
        } catch (Exception $e) {
            throw new Exception('Failed to delete Zoom meeting: ' . $e->getMessage());
        }
    }

    private function getZoomAccessToken()
    {
        $accountId = env('ZOOM_ACCOUNT_ID');
        $clientId = env('ZOOM_CLIENT_ID');
        $clientSecret = env('ZOOM_CLIENT_SECRET');

        if (!$accountId || !$clientId || !$clientSecret) {
            throw new Exception('Zoom credentials not configured. Please check your .env file.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
        ])->asForm()->post("https://zoom.us/oauth/token", [
            'grant_type' => 'account_credentials',
            'account_id' => $accountId
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        } else {
            throw new Exception('Failed to get Zoom access token: ' . $response->body());
        }
    }

    private function formatZoomTime($time)
    {
        return \Carbon\Carbon::parse($time)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
    }

    private function generateRandomPassword()
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
    }
}