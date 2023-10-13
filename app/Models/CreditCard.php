<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_inscription_id',
        'number_of_installments'
        // 'available_until',
        // 'discount'
    ];

    public function inscription()
    {
        return $this->belongsTo(EventInscription::class);
    }
}
