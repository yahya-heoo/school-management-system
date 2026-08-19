<?php
return [
    'api_key' => env('ZOOM_API_KEY', ''),
    'api_secret' => env('ZOOM_API_SECRET', ''),
    'account_id' => env('ZOOM_ACCOUNT_ID', ''),
    'base_url' => env('ZOOM_BASE_URL', 'https://api.zoom.us/v2/'),
    'webhook_secret' => env('ZOOM_WEBHOOK_SECRET', ''),
    
    'routes' => [
        'prefix' => 'api/zoom',
        'middleware' => ['api', 'auth:sanctum'],
        'webhook_path' => 'webhook',
        'webhook_middleware' => ['api'],
    ],
    
    'default_settings' => [
        'host_video' => true,
        'participant_video' => true,
        'join_before_host' => false,
        'mute_upon_entry' => true,
        'waiting_room' => true,
        'approval_type' => 0,
        'audio' => 'both',
        'auto_recording' => 'none',
    ],
    
    'timezone' => env('ZOOM_TIMEZONE', config('app.timezone', 'UTC')),
];