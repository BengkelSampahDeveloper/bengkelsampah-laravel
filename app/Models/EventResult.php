<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'activity_summary',
        'photos',
        'waste_saved_kg',
        'created_by',
    ];

    protected $casts = [
        'photos' => 'array',
        'waste_saved_kg' => 'decimal:2',
    ];

    /**
     * Get the event that this result belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the admin that created this result.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
