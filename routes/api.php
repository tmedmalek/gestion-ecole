<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserParentController;
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

Route::prefix('eleves')->controller(EleveController::class)->middleware(['auth:api', 'scopes:admin'])->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('professeurs')->controller(ProfesseurController::class)->middleware(['auth:api', 'scopes:admin'])->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
Route::prefix('parents')->controller(UserParentController::class)->middleware(['auth:api', 'scopes:admin'])->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('login')->controller(AuthController::class)->group(function () {
    Route::post('', 'login');
});

Route::prefix('logout')->controller(AuthController::class)->group(function () {
    Route::get('', 'logout')->middleware('auth:api');
});

Route::prefix('forgot-password')->controller(ForgotPasswordController::class)->group(function () {
    Route::post('', 'ForgotPassword');
});


Route::prefix('verifytoken')->controller(ForgotPasswordController::class)->group(function () {
    Route::get('', 'Verifytoken');
});


Route::prefix('resetpassword')->controller(ResetPasswordController::class)->group(function () {
    Route::post('', 'ResetPassword');
});

Route::prefix('notes')->controller(NoteController::class)->group(function () {
    Route::get('', 'index');
});


Route::prefix('classes')->controller(ClasseController::class)->middleware(['auth:api', 'scopes:admin'])->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});


Route::prefix('matieres')->controller(MatiereController::class)->middleware(['auth:api', 'scopes:admin'])->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});


Route::prefix('evenements')->controller(EvenementController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('niveaux')->controller(NiveauController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
