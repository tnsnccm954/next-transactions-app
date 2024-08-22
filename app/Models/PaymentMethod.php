<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_type_id',
        'name',
        'code',
        'default_display_name',
        'description',
        'is_active',
        'transaction_fee',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class);
    }
}
