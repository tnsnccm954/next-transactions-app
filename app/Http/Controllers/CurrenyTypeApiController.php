<?php

namespace App\Http\Controllers;

use App\Models\CurrencyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CurrenyTypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencyTypes = Cache::rememberForever('ALL_CURRENCY_TYPES',fn()=>CurrencyType::all());

        return response()->json($currencyTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CurrencyType $currency_type)
    {
        return response()->json($currency_type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
