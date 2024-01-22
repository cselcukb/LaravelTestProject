<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\API\MarkerAPIController;
use Illuminate\Cache\RateLimiting\Limit;

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

RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(15)->by($request->ip());
});

Route::get('/markers',                  [MarkerAPIController::class, 'list']);
Route::post('/markers/calculateRoute',  [MarkerAPIController::class, 'calculateRoute']);
Route::get('/markers/{markerId}',       [MarkerAPIController::class, 'show']);
Route::post('/markers',                 [MarkerAPIController::class, 'add']);
Route::post('/markers/{markerId}',      [MarkerAPIController::class, 'edit']);
