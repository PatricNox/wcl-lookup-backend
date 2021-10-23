<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Fallback route */
Route::fallback(function () {
    return response()->json([__('error') => __('Route doesn\'t exist.')], 404);
});

/* WCL */
Route::prefix('wcl')->group(function () {
    Route::post('parses/lookup', 'Api\WCLController@lookupThroughParses');
});
