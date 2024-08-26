<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $params = $request->validate([
            'transaction_type_id' => 'sometimes|exists:transaction_types,id|integer',
            'transaction_state_id' => 'sometimes|exists:transaction_states,id|integer',
            'page' => 'sometimes|integer',
            'per_page' => 'sometimes|integer',
        ]);

        $transactions = $user->transactions();
        if (isset($params['transaction_type_id'])) {
            $transactions->where('transaction_type_id', $params['transaction_type_id']);
        }
        if (isset($params['transaction_state_id'])) {
            $transactions->where('transaction_state_id', $params['transaction_state_id']);
        }

        $transactions = $transactions->paginate($params['per_page'] ?? 10)->get();

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $params = $request->validate([
            // 'user_id' => 'required|exists:users,id|integer',
            'transaction_type_id' => 'required|exists:transaction_types,id|integer',
            'transaction_state_id' => 'required|exists:transaction_states,id|integer',
            'sender_wallet_id' => 'required|exists:wallets,id|integer',
            'receiver_wallet_id' => 'sometimes|exists:wallets,id|integer',
            'amount' => 'required|numeric',
            'transaction_fee' => 'sometimes|numeric',
            'expires_at' => 'sometimes|datetimez',
        ]);

        $params['user_id'] = $request->user()->id;
        $transaction = new Transaction($params);
        $transaction->transaction_fee = key_exists('transaction_fee', $params) ? $params['transaction_fee'] : 0;
        $transaction->expires_at =  key_exists('expires_at', $params) ? $params['expires_at'] : now()->addMinutes(15);
        $transaction->save();

        // can start confirmation process here depending on transaction type
        // should be queued

        // $transaction->confirm();

        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $params = $request->validate([
            // 'transaction_type_id' => 'sometimes|exists:transaction_types,id|integer',
            'transaction_state_id' => 'sometimes|exists:transaction_states,id|integer',
            // 'sender_wallet_id' => 'sometimes|exists:wallets,id|integer',
            // 'receiver_wallet_id' => 'sometimes|exists:wallets,id|integer',
            // 'amount' => 'sometimes|numeric',
            'transaction_fee' => 'sometimes|numeric',
            'is_completed' => 'sometimes|boolean',
            // 'expires_at' => 'sometimes|datetimez',
        ]);


        $isExpired = now()->gt($transaction->expires_at);

        if(key_exists('is_completed', $params) && !$isExpired) {
            $transaction->is_completed = $params['is_completed'];
            if($transaction->is_completed) {
                $transaction->completed_at = now();
            }
            $transactionType = $transaction->transactionType;
            switch($transactionType->name) {
                case 'deposit':
                    $transaction->senderWallet->balance += $transaction->amount;
                    $transaction->senderWallet->save();
                    break;
                case 'withdrawal':
                    $transaction->senderWallet->balance -= $transaction->amount;
                    $transaction->senderWallet->save();
                    break;
                case 'transfer':
                    // notify user of transaction completion
                    $transaction->senderWallet->balance -= $transaction->amount;
                    $transaction->senderWallet->save();
                    $transaction->receiverWallet->balance += $transaction->amount;
                    $transaction->receiverWallet->save();
                    break;
            }
        }

        $transaction->fill($params);
        $transaction->save();
        return response()->json($transaction);
    }
    
}
