<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BaseController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/prepare-league', [BaseController::class, 'prepareLeague'])->name('prepareLeague');
Route::get('/simulate-match', [BaseController::class, 'simulateMatch'])->name('simulateMatch');
Route::get('/simulate-league', [BaseController::class, 'simulateLeague'])->name('simulateLeague');
