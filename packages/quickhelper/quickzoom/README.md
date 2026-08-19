
# QuickZoom - Laravel Zoom Integration Package

[![Latest Version](https://img.shields.io/packagist/v/quickhelper/quickzoom.svg?style=flat-square)](https://packagist.org/packages/quickhelper/quickzoom)
[![Total Downloads](https://img.shields.io/packagist/dt/quickhelper/quickzoom.svg?style=flat-square)](https://packagist.org/packages/quickhelper/quickzoom)
[![License](https://img.shields.io/packagist/l/quickhelper/quickzoom.svg?style=flat-square)](https://packagist.org/packages/quickhelper/quickzoom)

A complete solution for integrating Zoom video conferencing into Laravel applications. Manage meetings, webinars, participants, and recordings with an elegant API.

## Features

✅ **Complete Meeting Management** - Create, update, delete, and list Zoom meetings  
✅ **Webinar Support** - Schedule and manage webinars  
✅ **Participant Tracking** - Track meeting participants and attendance  
✅ **Recording Management** - Access and manage meeting recordings  
✅ **Webhook Integration** - Real-time event notifications  
✅ **Database Storage** - Store meeting data locally  
✅ **Laravel Integration** - Native Laravel service provider, facades, and events  

## Requirements

- PHP 8.0+
- Laravel 9.x, 10.x, or 11.x
- Zoom OAuth 2.0 Server-to-Server App Credentials

## Installation

1. Install via Composer:

```bash
composer require quickhelper/quickzoom
```

2. Publish config and migrations:

```bash
php artisan vendor:publish --provider="QuickZoom\Providers\QuickZoomServiceProvider"
```

3. Add Zoom credentials to your `.env`:

```ini
ZOOM_API_KEY=your_zoom_api_key
ZOOM_API_SECRET=your_zoom_api_secret
ZOOM_ACCOUNT_ID=your_zoom_account_id
ZOOM_WEBHOOK_SECRET=your_webhook_secret  # Optional
```

**Important:** Zoom has deprecated JWT authentication. You must create an OAuth 2.0 Server-to-Server app in the Zoom Marketplace and use those credentials.

4. Run migrations:

```bash
php artisan migrate
```

## Usage

### Basic Meeting Management

```php
use QuickZoom\Facades\QuickZoom;

// Create a simple meeting
$meeting = QuickZoom::createMeeting('me', [
    'topic' => 'Team Meeting',
    'start_time' => now()->addDay()->toIso8601String(),
    'duration' => 60,
    'agenda' => 'Quarterly planning session'
]);

echo "Meeting created successfully!";
echo "Join URL: " . $meeting['join_url'];
echo "Meeting ID: " . $meeting['id'];
echo "Password: " . $meeting['password'];

// List all meetings
$meetings = QuickZoom::listMeetings();
foreach ($meetings['meetings'] as $meeting) {
    echo "Meeting: " . $meeting['topic'] . " - " . $meeting['start_time'];
}

// Get specific meeting details
$meetingDetails = QuickZoom::getMeeting($meetingId);
echo "Meeting Status: " . $meetingDetails['status'];

// Update a meeting
$updatedMeeting = QuickZoom::updateMeeting($meetingId, [
    'topic' => 'Updated Meeting Title',
    'duration' => 90
]);

// End an ongoing meeting
QuickZoom::endMeeting($meetingId);

// Delete a meeting
QuickZoom::deleteMeeting($meetingId);
```

### Advanced Meeting with Custom Settings

```php
$advancedMeeting = QuickZoom::createMeeting('me', [
    'topic' => 'Advanced Workshop',
    'type' => 2, // Scheduled meeting
    'start_time' => '2024-12-25T10:00:00Z',
    'duration' => 120,
    'timezone' => 'Africa/Cairo',
    'password' => '123456',
    'agenda' => 'Advanced Laravel Development Workshop',
    'settings' => [
        'host_video' => true,
        'participant_video' => false,
        'join_before_host' => true,
        'mute_upon_entry' => true,
        'waiting_room' => false,
        'approval_type' => 0,
        'audio' => 'both',
        'auto_recording' => 'cloud',
        'alternative_hosts' => 'assistant@company.com'
    ]
]);
```

### Working with Participants

```php
// Register a participant
$registration = QuickZoom::registerParticipant($meetingId, [
    'email' => 'participant@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'org' => 'Tech Company',
    'job_title' => 'Developer'
]);

echo "Registration successful!";
echo "Join URL: " . $registration['join_url'];

// List meeting participants (after meeting)
$participants = QuickZoom::listParticipants($meetingId);
foreach ($participants['participants'] as $participant) {
    echo $participant['name'] . " joined at " . $participant['join_time'];
}
```

### Using in Controllers

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QuickZoom\Facades\QuickZoom;
use QuickZoom\Models\ZoomMeeting;

class MeetingController extends Controller
{
    public function createMeeting(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:200',
            'start_time' => 'required|date|after:now',
            'duration' => 'required|integer|min:15|max:300'
        ]);

        try {
            // Create meeting in Zoom
            $zoomMeeting = QuickZoom::createMeeting('me', [
                'topic' => $request->topic,
                'start_time' => $request->start_time,
                'duration' => $request->duration,
                'agenda' => $request->agenda
            ]);

            // Save to database
            $meeting = ZoomMeeting::create([
                'zoom_id' => $zoomMeeting['id'],
                'user_id' => auth()->id(),
                'topic' => $zoomMeeting['topic'],
                'start_url' => $zoomMeeting['start_url'],
                'join_url' => $zoomMeeting['join_url'],
                'password' => $zoomMeeting['password'],
                'start_time' => $zoomMeeting['start_time'],
                'duration' => $zoomMeeting['duration']
            ]);

            return response()->json([
                'success' => true,
                'meeting' => $meeting
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
```

### Webhook Setup

1. Configure your Zoom app webhook in the Zoom Marketplace
2. Add the webhook URL to your Zoom app settings (typically `https://yourdomain.com/api/zoom/webhook`)
3. Listen for events in your Laravel application:

```php
// In your EventServiceProvider
protected $listen = [
    \QuickZoom\Events\ZoomMeetingStarted::class => [
        \App\Listeners\HandleMeetingStarted::class,
    ],
    \QuickZoom\Events\ZoomMeetingEnded::class => [
        \App\Listeners\HandleMeetingEnded::class,
    ],
    \QuickZoom\Events\ZoomParticipantJoined::class => [
        \App\Listeners\HandleParticipantJoined::class,
    ],
    \QuickZoom\Events\ZoomParticipantLeft::class => [
        \App\Listeners\HandleParticipantLeft::class,
    ],
];
```

### Event Listener Example

```bash
php artisan make:listener HandleMeetingStarted
```

```php
<?php
namespace App\Listeners;

use QuickZoom\Events\ZoomMeetingStarted;
use QuickZoom\Models\ZoomMeeting;

class HandleMeetingStarted
{
    public function handle(ZoomMeetingStarted $event)
    {
        $meetingId = $event->payload['payload']['object']['id'];
        
        // Update meeting status in database
        ZoomMeeting::where('zoom_id', $meetingId)
            ->update(['status' => 'started']);
        
        // Send notifications, log activity, etc.
    }
}
```

### Available Methods

| Method | Description |
|--------|-------------|
| `listMeetings()` | List all meetings |
| `getMeeting()` | Get meeting details |
| `createMeeting()` | Schedule a new meeting |
| `updateMeeting()` | Update meeting details |
| `deleteMeeting()` | Delete a meeting |
| `endMeeting()` | End an ongoing meeting |
| `listParticipants()` | List meeting participants |
| `registerParticipant()` | Register participant for meeting |
| `listRecordings()` | Get meeting recordings |
| `createWebinar()` | Schedule a webinar |
| `listWebinars()` | List scheduled webinars |

## Configuration

Publish the configuration file to customize:

```bash
php artisan vendor:publish --tag=quickzoom-config
```

Available configuration options:

```php
return [
    'api_key' => env('ZOOM_API_KEY'),
    'api_secret' => env('ZOOM_API_SECRET'),
    'base_url' => 'https://api.zoom.us/v2/',
    'webhook_secret' => env('ZOOM_WEBHOOK_SECRET'),
    
    'default_settings' => [
        'host_video' => true,
        'participant_video' => true,
        // ... other meeting defaults
    ],
    
    'routes' => [
        'prefix' => 'api/zoom',
        'middleware' => ['api', 'auth:sanctum'],
        'webhook_path' => 'webhook',
    ]
];
```

## Security

- Uses JWT authentication with Zoom API
- Webhook signature verification
- Encrypted API communication
- Token rotation and caching

## Testing

Run the tests with:

```bash
composer test
```

## 📚 Documentation

- **[Quick Start Guide](QUICK_START.md)** - Get started in 5 minutes
- **[Complete Examples](EXAMPLES.md)** - Comprehensive usage examples  
- **[API Testing Guide](API_TESTING.md)** - Test your integration
- **[FAQ](FAQ.md)** - Frequently asked questions
- **[Development Guide](DEVELOPMENT.md)** - For contributors

## 🔧 Troubleshooting

### Common Issues

**Authentication Error:**
- Ensure you're using OAuth 2.0 Server-to-Server app (not JWT)
- Verify your API Key, Secret, and Account ID are correct
- Check that your Zoom app has the required scopes

**Meeting Creation Fails:**
- Verify the start time is in the future
- Check the duration is between 15-300 minutes
- Ensure the timezone is valid

**Webhook Issues:**
- Make sure your webhook URL is publicly accessible
- Verify HTTPS is enabled
- Check the webhook secret matches your configuration

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for recent changes.

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). See [LICENSE.md](LICENSE.md) for more information.

## Support

For issues and feature requests, please [open an issue](https://github.com/quickhelper/quickzoom/issues).

## Credits

Created with ❤️ by [Yossef Ashraf](mailto:yossefff2001@gmail.com)
```

