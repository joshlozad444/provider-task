<?php

use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(ProviderController::class)->group(function() {
    Route::get('/providers', 'getProviders');
    Route::post('/providers', 'addProvider');
    Route::put('/providers/{provider_id}', 'updateProvider');
    Route::delete('/providers/{provider_id}', 'deleteProvider');
});
