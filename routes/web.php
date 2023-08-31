<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\TeamLeagueController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Match_;

Route::get('/', function () {
    return view('welcome');
});

//* Trae Todas la peticiones que tenemos en el controlador
Route::resource("/teams", TeamController::class);

Route::resource("/leagues", LeagueController::class);
Route::resource("/matches", MatchesController::class);
Route::post('matches/generate/{leagueId}', [MatchesController::class, 'generateMatchesForLeague']);

Route::put('/matches/{id}/generate-result', [MatchesController::class, 'generateRandomResult']);


Route::post('/leagues/{id}/generar-partidos', [LeaguesController::class, 'generar-partidos']); 
Route::get('/leagues/{id}/teams', [LeagueController::class, 'showTeamsInLeague']);

Route::resource("/teamLeagues", TeamLeagueController::class);
Route::get('/teams/{id}/edit', [TeamController::class, 'edit'])->name('teams.edit');

Route::get("{any}", function () {
    return view('welcome');
})->where("any", ".*");