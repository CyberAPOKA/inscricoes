<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'file_type',
        'index'
    ];

    public function info()
    {
        return $this->hasMany(LogoInfo::class)->orderBy('index');
    }
}
