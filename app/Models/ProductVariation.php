<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_product_id',
        'variation',
        'amount'
    ];

    public function product()
    {
        return $this->belongsTo(EventProduct::class);
    }
}
