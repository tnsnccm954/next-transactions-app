<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'default_display_name ',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }   
}
