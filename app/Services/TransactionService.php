<?php

namespace App\Services;

use App\Models\Transaction;


class TransactionService {
    
    // deposit add money to wallet
    public function deposit($wallet, $amount) {
        $transaction = new Transaction();
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $amount;
        $transaction->type = 'deposit';
        $transaction->save();
        $wallet->balance += $amount;
        $wallet->save();
        return $transaction;
    }

    // withdrawn deduct money from wallet
    public function withdraw($wallet, $amount) {
        $transaction = new Transaction();
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $amount;
        $transaction->type = 'withdraw';
        $transaction->save();
        $wallet->balance -= $amount;
        $wallet->save();
        return $transaction;
    }

    // transfer transfer money from one wallet to another wallet
    // public function transfer(array $transactionInfo) {
    //     $transaction
        
    //     return $transaction;
    // }
}

