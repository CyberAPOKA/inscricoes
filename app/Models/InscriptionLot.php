<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptionLot extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_inscription_id',
        'name',
        'start_date',
        'start_hour',
        'end_date',
        'end_hour'
    ];

    public function inscription()
    {
        return $this->belongsTo(EventInscription::class);
    }

    public function eventKits()
    {
        return $this->hasMany(EventKitInscriptionLot::class);
    }
}
