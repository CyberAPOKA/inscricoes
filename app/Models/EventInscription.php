<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'participants',
        'modality',
        'restrictions',
        'index',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class)->orderBy('index');
    }

    public function lots()
    {
        return $this->hasMany(InscriptionLot::class);
    }

    public function route()
    {
        return $this->hasMany(RouteInscription::class);
    }

    public function kits()
    {
        return $this->hasMany(KitInscription::class)->orderBy('index');
    }

    public function boleto()
    {
        return $this->hasOne(Boleto::class);
    }

    public function pix()
    {
        return $this->hasOne(Pix::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }
}
