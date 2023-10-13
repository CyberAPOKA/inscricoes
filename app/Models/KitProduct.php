<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_kit_id',
        'event_product_id',
        'quantity'
    ];

    public function kits()
    {
        return $this->belongsToMany(EventKit::class, 'kit_product', 'event_product_id', 'event_kit_id');
    }

    public function products()
    {
        return $this->belongsToMany(EventProduct::class, 'kit_product', 'event_kit_id', 'event_product_id');
    }
}
