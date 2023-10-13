<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGraphicMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'file_name',
        'file_path',
        'file_type',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
