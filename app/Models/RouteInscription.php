<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_route_id',
        'event_inscription_id',
    ];

    public function eventRoute()
    {
        return $this->belongsTo(EventRoute::class);
    }

    public function eventInscription()
    {
        return $this->belongsTo(EventInscription::class);
    }
}
