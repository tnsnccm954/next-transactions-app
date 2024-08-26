<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TransactionTypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionTypes = Cache::rememberForever('ALL_TRANSACTION_TYPES',fn()=>TransactionType::all());
        return response()->json($transactionTypes);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionType $transaction_type)
    {
        return response()->json($transaction_type);
    }
}
