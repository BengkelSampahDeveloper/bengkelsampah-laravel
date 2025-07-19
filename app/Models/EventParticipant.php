<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'user_name',
        'user_identifier',
        'join_datetime',
    ];

    protected $casts = [
        'join_datetime' => 'datetime',
    ];

    /**
     * Get the event that the user is participating in.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
