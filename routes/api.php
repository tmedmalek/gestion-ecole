<?php

use App\Http\Controllers\EleveController;
use App\Http\Controllers\ProfesseurController;
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

Route::prefix('eleves')->controller(EleveController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('professeurs')->controller(ProfesseurController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
