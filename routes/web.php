<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BaseController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/prepare-league', [BaseController::class, 'prepareLeague'])->name('prepareLeague');
Route::get('/simulate-week', [BaseController::class, 'simulateWeek'])->name('simulateWeek');
Route::get('/simulate-league', [BaseController::class, 'simulateLeague'])->name('simulateLeague');

Route::get('/get-fixture', [BaseController::class, 'getFixture'])->name('getFixture');

