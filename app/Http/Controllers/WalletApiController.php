<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $wallets = $user->wallets()->get();
        return response()->json($wallets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            // 'user_id' => 'required|exists:users,id|integer',
            'currency_id' => 'required|exists:currencies,id|integer',
            'address' => 'sometimes|string',
            'is_default' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ]);
        $user = $request->user();
        $params['user_id'] = $user->id;

        $wallet = new Wallet($params);
        $wallet->save();

        return response()->json($wallet);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        return response()->json($wallet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $params = $request->validate([
            'currency_id' => 'required|exists:currencies,id|integer',
            'address' => 'sometimes|string',
            'is_default' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ]);

        $wallet->update($params);

        return response()->json($wallet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return response()->json(['message' => 'Wallet deleted']);
    }
}
