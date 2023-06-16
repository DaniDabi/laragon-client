<?php

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
Route::get('students', [App\Http\Controllers\API\StudentController::class, 'index']);
Route::post('students', [App\Http\Controllers\API\StudentController::class, 'store']);
Route::get('students/{id}', [App\Http\Controllers\API\StudentController::class, 'show']);
Route::get('students/{id}/edit', [App\Http\Controllers\API\StudentController::class, 'edit']);
Route::put('students/{id}/update', [App\Http\Controllers\API\StudentController::class, 'update']);
Route::delete('students/{id}/delete', [App\Http\Controllers\API\StudentController::class, 'delete']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
