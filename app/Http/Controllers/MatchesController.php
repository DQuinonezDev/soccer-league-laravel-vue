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

        $match = new Matches();

        $match->league_id = $request->input('league_id');
        $match->homeTeam_id = $request->input('homeTeam_id');
        $match->awayTeam_id = $request->input('awayTeam_id');
        $match->match_date = $matchDate;

        $match->save();

        return response()->json(['message' => 'Match created successfully'], 200);
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
