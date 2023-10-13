<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'maximum_amount',
        'extra'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function products()
    {
        return $this->hasMany(KitProduct::class);
    }

    public function kits()
    {
        return $this->belongsToMany(EventKit::class, 'kit_products', 'event_product_id', 'event_kit_id')->withPivot('quantity');
    }
}
