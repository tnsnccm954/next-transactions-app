<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'transaction_type_id',
        'transaction_state_id',
        'sender_wallet_id',
        'receiver_wallet_id',
        'user_id',
        'amount',
        'transaction_fee',
        'expires_at',
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function transactionState()
    {
        return $this->belongsTo(TransactionState::class);
    }   

    public function senderWallet()
    {
        return $this->belongsTo(Wallet::class, 'sender_wallet_id');
    }   

    public function receiverWallet()
    {
        return $this->belongsTo(Wallet::class, 'receiver_wallet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
