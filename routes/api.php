<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EntityFieldController;
use App\Http\Controllers\EntityFieldFixedValueController;
use App\Http\Controllers\EntityValueController;
use App\Http\Controllers\StatisticController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('entity', EntityController::class);
Route::resource('{entity}/entity_field', EntityFieldController::class);
Route::resource('{entity}/entity_value', EntityValueController::class);
Route::resource('{entity_field}/entity_field_fixed_value', EntityFieldFixedValueController::class);

Route::get('{entity}/get_statistics',  [StatisticController::class, 'getStatistics']);




