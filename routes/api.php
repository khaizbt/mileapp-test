<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::prefix('v1/package')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [PackageController::class, 'store']);
    Route::get('/', [PackageController::class, 'listPackage']);
    Route::get('/{id}', [PackageController::class, 'detailPackage']);
    Route::put('/{id}', [PackageController::class, 'updatePackage']);
    Route::patch('/{id}', [PackageController::class, 'patchPackage']);
    Route::delete('/{id}', [PackageController::class, 'destroy']);
});
