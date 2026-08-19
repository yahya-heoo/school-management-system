<?php
namespace QuickZoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'zoom_id', 'user_id', 'topic', 'agenda', 'start_url', 'join_url',
        'password', 'start_time', 'duration', 'status', 'settings'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model', 'App\Models\User'));
    }

    public function participants()
    {
        return $this->hasMany(ZoomMeetingParticipant::class);
    }

    public function recordings()
    {
        return $this->hasMany(ZoomRecording::class);
    }
}