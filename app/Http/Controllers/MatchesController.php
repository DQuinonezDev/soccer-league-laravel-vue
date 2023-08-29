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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'homeTeam_id' => 'required|exists:teams,id',
            'awayTeam_id' => 'required|exists:teams,id',
        ]);
    
        $homeTeamLeague = TeamLeague::where('team_id', $request->input('homeTeam_id'))
            ->where('league_id', $request->input('league_id'))
            ->first();
    
        $awayTeamLeague = TeamLeague::where('team_id', $request->input('awayTeam_id'))
            ->where('league_id', $request->input('league_id'))
            ->first();
    
        if (!$homeTeamLeague || !$awayTeamLeague) {
            return response()->json(['error' => 'Teams do not belong to the same league'], 400);
        }
    
        // Generar fecha válida (viernes, sábado o domingo)
        $validDays = ['Friday', 'Saturday', 'Sunday'];
        $matchDate = now()->startOfDay()->next($validDays[array_rand($validDays)]);
    
        // Generar hora aleatoria en formato 'H:i:s'
        $randomHour = rand(10, 20); // Entre las 10:00 y las 20:00 horas
        $allowedMinutes = [0, 20, 30, 50];
        $randomMinute = $allowedMinutes[array_rand($allowedMinutes)];
        $randomSecond = rand(0, 0);
        $matchTime = sprintf('%02d:%02d:%02d', $randomHour, $randomMinute, $randomSecond);
    
        $match = new Matches();
        $match->league_id = $request->input('league_id');
        $match->homeTeam_id = $request->input('homeTeam_id');
        $match->awayTeam_id = $request->input('awayTeam_id');
        $match->match_date = $matchDate;
        $match->match_time = $matchTime;
        $match->save();
    
        // Crear partido de vuelta (local y visitante)
        $returnMatchHome = new Matches();
        $returnMatchHome->league_id = $request->input('league_id');
        $returnMatchHome->homeTeam_id = $request->input('awayTeam_id');
        $returnMatchHome->awayTeam_id = $request->input('homeTeam_id');
        $returnMatchHome->match_date = $matchDate;
        $returnMatchHome->match_time = $matchTime;
        $returnMatchHome->first_leg_id = $match->id; // Establecer la relación con el partido de ida
        $returnMatchHome->save();
    
        // Actualizar el campo first_leg_id del partido de ida con el ID del partido de vuelta
        $match->first_leg_id = $returnMatchHome->id;
        $match->save();
    
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
