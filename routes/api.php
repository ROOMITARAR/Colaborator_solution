<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Person;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\FamilyTreeController;
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
Route::get('/people/{id}/family-tree', [FamilyTreeController::class,'show']);
Route::apiResource('/person', PersonController::class);
Route::apiResource('/family', FamilyController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
