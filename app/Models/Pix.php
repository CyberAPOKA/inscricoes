<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pix extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_inscription_id',
        // 'available_until',
        // 'discount'
    ];

    public function inscription()
    {
        return $this->belongsTo(EventInscription::class);
    }
}
