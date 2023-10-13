<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_kit_id',
        'event_inscription_id',
        'index'
    ];

    public function eventKit()
    {
        return $this->belongsTo(EventKit::class);
    }

    public function eventInscription()
    {
        return $this->belongsTo(EventInscription::class);
    }

    public function kit()
    {
        return $this->belongsTo(EventKit::class, 'event_kit_id', 'id');
    }

    public function inscription()
    {
        return $this->belongsTo(EventInscription::class, 'event_inscription_id', 'id');
    }
}
