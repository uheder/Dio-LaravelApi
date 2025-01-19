<?php

use App\Http\Controllers\SongsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function ()
{
    Route::get('/', [SongsController::class, 'listAll']);
    Route::post('/save', [SongsController::class, 'save']);
    Route::get('/list/{song}', [SongsController::class, 'list']);
    Route::put('/update/{id}', [SongsController::class, 'update']);
    Route::delete('/delete/{id}', [SongsController::class, 'delete']);
});

