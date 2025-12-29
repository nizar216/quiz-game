<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::middleware('web')->group(function () {
    Route::get('/', [GameController::class, 'dashboard'])->name('judge.dashboard');
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::post('/games/{game}/rounds', [GameController::class, 'createRound'])->name('games.create-round');
    Route::get('/rounds/{round}', [GameController::class, 'roundView'])->name('games.round-view');
    Route::post('/rounds/{round}/score', [GameController::class, 'scoreRound'])->name('games.score-round');
    Route::get('/games/{game}/scoreboard', [GameController::class, 'scoreboard'])->name('games.scoreboard');
});
