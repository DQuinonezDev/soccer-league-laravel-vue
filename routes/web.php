<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TeamLeagueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//* Trae Todas la peticiones que tenemos en el controlador
Route::resource("/teams", TeamController::class);

Route::resource("/leagues", LeagueController::class);

Route::resource("/teamLeagues", TeamLeagueController::class);

Route::get('/leagues/{id}/teams', [LeagueController::class, 'showTeamsInLeague']);
Route::post('/create-matches', [MatchController::class, 'createMatches']);
Route::get('/get-matches', [MatchController::class, 'getMatches']);
Route::get("{any}", function () {
    return view('welcome');
})->where("any", ".*");
