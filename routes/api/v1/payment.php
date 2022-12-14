<?php

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'api/v1'.
| These routes use the root namespace 'App\Http\Controllers\Api\V1'.
|
 */
use App\Base\Constants\Auth\Role;

/*
 * These routes are prefixed with 'api/v1/payment'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\Payment'.
 * These routes use the middleware group 'auth'.
 */
Route::prefix('payment')->namespace('Payment')->middleware('auth')->group(function () {

    /**
     * These routes use the middleware group 'role'.
     * These routes are accessible only by a user with the 'user' role.
     */
    Route::middleware(role_middleware(Role::mobileAppRoles()))->group(function () {
        // Card apis
        Route::post('card/add', 'PaymentController@addCard');
        Route::get('card/list', 'PaymentController@listCards');
        Route::post('card/make/default', 'PaymentController@makeDefaultCard');
        Route::delete('card/delete/{card}', 'PaymentController@deleteCard');
        // Braintree api token get list
        Route::get('client/token', 'PaymentController@getClientToken');
        // Add money to wallet

        Route::prefix('wallet')->group(function () {
            Route::post('add/money', 'PaymentController@addMoneyToWallet');
            Route::get('history', 'PaymentController@walletHistory');
            Route::get('withdrawal-requests','PaymentController@withDrawalRequests');
            Route::post('request-for-withdrawal','PaymentController@requestForWithdrawal');
        });


    /**
     * Braintree Payment Gateway
     *
     * */
    Route::prefix('braintree')->namespace('Braintree')->group(function(){

        Route::get('client/token', 'BraintreeController@getClientToken');
        Route::post('add/money', 'BraintreeController@addMoneyToWallet');

    });

    /**
     * Stripe Payment Gateway
     *
     * */
    Route::prefix('stripe')->namespace('Stripe')->group(function(){

        Route::post('intent', 'StripeController@createStripeIntent');
        Route::post('add/money', 'StripeController@addMoneyToWallet');

    });

    /**
     * Razerpay Payment Gateway
     *
     * */
    Route::prefix('razerpay')->namespace('Razerpay')->group(function(){

        Route::post('add-money', 'RazerpayController@addMoneyToWallet');
    });

    /**
     * PayMob Payment Gateway
     *
     * */

    Route::prefix('paymob')->namespace('Paymob')->group(function(){

        Route::post('add/money', 'PaymobController@addMoneyToWallet');
    });

    /**
     * Paystack Payment Gateway
     *
     * */
    Route::prefix('paystack')->namespace('Paystack')->group(function(){
        Route::post('initialize','PaystackController@initialize');
        Route::post('add-money', 'PaystackController@addMoneyToWallet');

    });

      /**
     * Flutterwave Payment Gateway
     *
     * */
    Route::prefix('flutter-wave')->namespace('FlutterWave')->group(function(){
        // Route::post('initialize','FlutterWaveController@initialize');
        Route::post('add-money', 'FlutterWaveController@addMoneyToWallet');

    });

    Route::prefix('telr')->namespace('telr')->group(function(){
        // Route::post('initialize','FlutterWaveController@initialize');
        Route::post('add-money', 'TelrController@addMoneyToWallet');

    });


    Route::get('/test-payment', function(){
        $telrManager = new \TelrGateway\TelrManager();

        $billingParams = [
                'first_name' => 'Moustafa Gouda',
                'sur_name' => 'Bafi',
                'address_1' => 'Gnaklis',
                'address_2' => 'Gnaklis 2',
                'city' => 'Alexandria',
                'region' => 'San Stefano',
                'zip' => '11231',
                'country' => 'EG',
                'email' => 'example@company.com',
            ];

        return $telrManager->pay('1', '10', 'DESCRIPTION ...', $billingParams)->redirect();

    });

    /**
     * Cashfree Payment Gateway
     *
     * */
    Route::prefix('cashfree')->namespace('Cashfree')->group(function(){
        Route::post('generate-cftoken','CashfreePaymentController@generateCftoken');
        Route::any('add-money-to-wallet-webhooks', 'CashfreePaymentController@addMoneyToWalletwebHooks');

    });

    });


});
