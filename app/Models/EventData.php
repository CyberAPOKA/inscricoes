<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventData extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'organizer',
        'category',
        'date',
        'hour',
        'one_more_day',
        'final_date',
        'final_hour',
        'start_disclosure_date',
        'start_disclosure_hour',
        'end_disclosure_date',
        'end_disclosure_hour',
        'description',
        'terms_and_conditions',
        'observation',
        'maximum_amount_tickets',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
