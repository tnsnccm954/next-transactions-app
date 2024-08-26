<?php

use App\Http\Controllers\CurrenyApiController;
use App\Http\Controllers\CurrenyTypeApiController;
use App\Http\Controllers\OrderApiController;
use App\Http\Controllers\OrderStatusApiController;
use App\Http\Controllers\OrderTypeApiController;
use App\Http\Controllers\PaymentMethodApiController;
use App\Http\Controllers\TransactionApiController;
use App\Http\Controllers\TransactionStateApiController;
use App\Http\Controllers\TransactionTypeApiController;
use App\Http\Controllers\UserPaymentMethodApiController;
use App\Http\Controllers\WalletApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// lookup routes
Route::apiResource('currency-types', CurrenyTypeApiController::class)->only(['index','show']);
Route::apiResource('currencies', CurrenyApiController::class)->only(['index','show']);
Route::apiResource('order-statuses', OrderStatusApiController::class)->only(['index','show']);
Route::apiResource('order-types', OrderTypeApiController::class)->only(['index','show']);
Route::apiResource('transaction-types', TransactionTypeApiController::class)->only(['index','show']);
Route::apiResource('transaction-states', TransactionStateApiController::class)->only(['index','show']);
Route::apiResource('payment-methods', PaymentMethodApiController::class)->only(['index','show']);

// Resource routes
// Wallet, UserPaymentMethod, Order, Transaction
Route::apiResource('orders', OrderApiController::class)->only(['index','show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('wallets', WalletApiController::class);
    // transactions
    Route::apiResource('transactions', TransactionApiController::class)->except(['delete']);

    // user orders
    Route::prefix('users/{user}')->group(function(){
        Route::get('orders', [OrderApiController::class,'indexUserOrders']);
        Route::get('orders/{order}', [OrderApiController::class,'showUserOrder']);
        Route::post('orders', [OrderApiController::class,'storeUserOrder']);
        Route::put('orders/{order}', [OrderApiController::class,'updateUserOrder']);
        // Route::delete('orders/{order}', [OrderApiController::class,'deleteUserOrder']);

        Route::apiResource('payment-methods', UserPaymentMethodApiController::class);
    });

    Route::prefix('orders/{order}')->group(function(){
        Route::get('transactions', [OrderApiController::class,'indexOrderTransactions']);
        Route::get('transactions/{transaction}', [OrderApiController::class,'showOrderTransaction']);
        Route::post('transactions', [OrderApiController::class,'storeOrderTransaction']);
        Route::put('transactions/{transaction}', [OrderApiController::class,'updateOrderTransaction']);
    });
});
