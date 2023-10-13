<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'observation',
        'image_name',
        'image_path',
        'link_embed'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(RouteInscription::class);
    }
}
