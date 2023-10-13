<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'zip_code',
        'city',
        'state',
        'street',
        'number',
        'complement',
        'google_maps_link',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
