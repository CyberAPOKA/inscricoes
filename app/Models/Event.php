<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'has_products_and_kits',
        'boleto_available_until',
        'boleto_discount',
        'pix_available_until',
        'pix_discount',
        'credit_card_allow_payment_in_up_to',
        'credit_card_installments_permitted_for_amounts_above',
        'credit_card_minimum_installment_value',
        'credit_card_available_until',
        'credit_card_discount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function data()
    {
        return $this->hasOne(EventData::class);
    }

    public function regulation()
    {
        return $this->hasOne(EventRegulation::class);
    }

    public function location()
    {
        return $this->hasOne(EventLocation::class);
    }

    public function materials()
    {
        return $this->hasMany(EventGraphicMaterial::class);
    }

    public function logos()
    {
        return $this->hasMany(EventLogo::class)->orderBy('index');
    }

    public function inscriptions()
    {
        return $this->hasMany(EventInscription::class)->orderBy('index');
    }

    public function routes()
    {
        return $this->hasMany(EventRoute::class);
    }

    public function kits()
    {
        return $this->hasMany(EventKit::class);
    }

    public function products()
    {
        return $this->hasMany(EventProduct::class);
    }
}
