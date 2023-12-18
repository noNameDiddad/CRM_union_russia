<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EntityFieldController;
use App\Http\Controllers\EntityFieldFixedValueController;
use App\Http\Controllers\EntityValueController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatisticController;
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
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api'], function () {
    Route::resource('entity', EntityController::class)->except(['index']);
    Route::get('entity', [EntityController::class, 'index']);
    Route::resource('permission', PermissionController::class);
    Route::resource('{entity}/entity_field', EntityFieldController::class);
    Route::resource('{entity}/entity_value', EntityValueController::class);
    Route::resource('{entity_field}/entity_field_fixed_value', EntityFieldFixedValueController::class);
    Route::resource('role', RoleController::class);

    Route::get('{entity}/get_statistics', [StatisticController::class, 'getStatistics']);

    Route::get('{entity}/{record}/{field}/get_files_list', [\App\Http\Controllers\FileController::class, 'index']);
    Route::get('{entity}/{record}/{field}/get_file', [\App\Http\Controllers\FileController::class, 'show']);
    Route::post('{entity}/{record}/{field}/add_file', [\App\Http\Controllers\FileController::class, 'store']);
    Route::put('{entity}/{record}/{field}/update_file', [\App\Http\Controllers\FileController::class, 'update']);
    Route::delete('{entity}/{record}/{field}/delete_file', [\App\Http\Controllers\FileController::class, 'destroy']);
    Route::get('/{dir}/list_files', [\App\Http\Controllers\FileController::class, 'list'])->where('dir', '.*');
});



