<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_type_id',
        'name',
        'code',
        'default_display_name',
        'is_default',
        'is_active',
    ];

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class);
    }
}
