<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Matches;
use App\Http\Controllers\Controller;
use App\Models\TeamLeague;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

        $matches = Matches::all(); // Obtener todos los partidos desde la base de datos

        return response()->json($matches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }



    public function generateRandomResult($matchId)
    {
        $match = Matches::find($matchId);

        if (!$match) {
            return response()->json(['message' => 'Match not found'], 404);
        }

        $homeScore = rand(0, 7); // Generar un resultado al azar para el equipo local
        $awayScore = rand(0, 7); // Generar un resultado al azar para el equipo visitante

        $match->home_team_score = $homeScore;
        $match->away_team_score = $awayScore;
        $match->save();

        return response()->json(['message' => 'Random result generated and updated'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function generateMatchesForLeague($leagueId)
    {
        $teamsInLeague = TeamLeague::where('league_id', $leagueId)->pluck('team_id');
        $validDays = ['Friday', 'Saturday', 'Sunday'];
        $teamCount = count($teamsInLeague);
        $daysBetweenMatches = 14; // Cada equipo juega una vez cada dos semanas

        $matchDate = now()->startOfDay()->next($validDays[array_rand($validDays)]);

        // Check if the first team is involved in the match and adjust the match date
        if ($teamsInLeague[0] == 1) {
            $matchDate = $matchDate->copy()->addDays($daysBetweenMatches);
        }

        for ($i = 0; $i < $teamCount - 1; $i++) {
            for ($j = $i + 1; $j < $teamCount; $j++) {
                $homeTeamId = $teamsInLeague[$i];
                $awayTeamId = $teamsInLeague[$j];

                $randomHour = rand(10, 20);
                $allowedMinutes = [0, 20, 30, 50];
                $randomMinute = $allowedMinutes[array_rand($allowedMinutes)];
                $randomSecond = rand(0, 59);
                $matchTime = sprintf('%02d:%02d:%02d', $randomHour, $randomMinute, $randomSecond);

                // Incrementar la fecha para la siguiente jornada si alguno de los equipos ya tiene un partido en esa fecha
                while (Matches::where('match_date', $matchDate->format('Y-m-d'))->where(function ($query) use ($homeTeamId, $awayTeamId) {
                    $query->where('homeTeam_id', $homeTeamId)->orWhere('awayTeam_id', $homeTeamId)
                        ->orWhere('homeTeam_id', $awayTeamId)->orWhere('awayTeam_id', $awayTeamId);
                })->exists()) {
                    $matchDate = $matchDate->copy()->addDays($daysBetweenMatches);
                }

                $match = new Matches();
                $match->league_id = $leagueId;
                $match->homeTeam_id = $homeTeamId;
                $match->awayTeam_id = $awayTeamId;
                $match->match_date = $matchDate;
                $match->match_time = $matchTime;
                $match->save();

                // Crear partido de vuelta (local y visitante)
                $returnMatch = new Matches();
                $returnMatch->league_id = $leagueId;
                $returnMatch->homeTeam_id = $awayTeamId;
                $returnMatch->awayTeam_id = $homeTeamId;
                $returnMatch->match_date = $matchDate->copy()->addDays($daysBetweenMatches)->startOfDay()->next($validDays[array_rand($validDays)]);
                $returnMatch->match_time = sprintf('%02d:%02d:%02d', rand(14, 22), $randomMinute, rand(0, 59));
                $returnMatch->first_leg_id = $match->id;
                $returnMatch->save();

                $match->first_leg_id = $returnMatch->id;
                $match->save();

                // Incrementar la fecha para la siguiente jornada
                $matchDate = $matchDate->copy()->addDays($daysBetweenMatches);
            }
        }

        return response()->json(['message' => 'Matches created successfully'], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
