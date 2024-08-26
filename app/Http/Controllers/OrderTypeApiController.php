<?php

namespace App\Http\Controllers;

use App\Models\OrderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderTypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderTypes = Cache::rememberForever('ALL_ORDER_TYPES',fn()=>OrderType::all());
        return response()->json($orderTypes);
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
    public function show(OrderType $order_type)
    {
        return response()->json($order_type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderType $orderType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderType $orderType)
    {
        //
    }
}
