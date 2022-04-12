<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SoortController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::apiResource('soorten', SoortController::class)->parameters(['soorten' => 'soort']);

Route::get('soorten', [SoortController::class, 'index']);
Route::get('soorten/{id}', [SoortController::class, 'show']);

Route::apiResource('restaurants', RestaurantController::class);
Route::get('soorten/{id}/restaurants', [RestaurantController::class, 'indexFunctie']);
