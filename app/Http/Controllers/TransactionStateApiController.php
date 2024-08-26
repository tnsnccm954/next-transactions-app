<?php

namespace App\Http\Controllers;

use App\Models\TransactionState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TransactionStateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionStates = Cache::rememberForever('ALL_TRANSACTION_STATES',fn()=>TransactionState::all());
        return response()->json($transactionStates);
    }


    /**
     * Display the specified resource.
     */
    public function show(TransactionState $transaction_state)
    {
        return response()->json($transaction_state);
    }

}
