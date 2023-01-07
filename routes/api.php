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

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/user/refresh-token', [\App\Http\Controllers\Api\ApiTokenController::class, 'update'])->name('refresh-token');

    // Columns CRUD
    Route::get('/lists', [\App\Http\Controllers\Api\ColumnController::class, 'index'])->name('lists.index');
    Route::post('/lists/create', [\App\Http\Controllers\Api\ColumnController::class, 'store'])->name('lists.store');

});
