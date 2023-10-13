<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventKitInscriptionLot extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscription_lot_id',
        'event_kit_id',
        'athletes_amount',
        'vacancies_number',
        'amount',
        'value',
        'senior_discount'
    ];

    public function kit()
    {
        return $this->belongsTo(EventKit::class, 'event_kit_id', 'id');
    }

    public function lot()
    {
        return $this->belongsTo(InscriptionLot::class, 'inscription_lot_id', 'id');
    }
}
