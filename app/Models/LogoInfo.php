<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_logo_id',
        'file_name',
        'file_path',
        'file_type',
        'index'
    ];

    public function logo()
    {
        return $this->hasMany(LogoInfo::class)->orderBy('index');
    }
}
