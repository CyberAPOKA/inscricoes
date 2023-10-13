<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventKit extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'event_inscription_id',
        'name',
        'observation',
        'athletes_amount',
        'image_name',
        'image_path'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(KitInscription::class);
    }

    public function products()
    {
        return $this->belongsToMany(EventProduct::class, 'kit_products', 'event_kit_id', 'event_product_id')->withPivot('quantity');
    }

    public function inscriptionLots()
    {
        return $this->hasMany(InscriptionLot::class);
    }
}
