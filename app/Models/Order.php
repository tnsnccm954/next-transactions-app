<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'order_type_id',
        'order_status_id',
        'payment_method_id',
        'user_id',
        'from_currency_id',
        'to_currency_id',
        'quantity',
        'price',
        'maximum',
        'minimum',
        'limit_transaction_time',
    ];

    public function orderType()
    {
        return $this->belongsTo(OrderType::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class,'order_transaction','order_id','transaction_id');
    }


}
