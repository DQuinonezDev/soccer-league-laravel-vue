<?php

namespace App\Http\Controllers;

use App\Models\TeamLeague;
use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamLeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamleague = TeamLeague::all();
        return response()->json($teamleague);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teamLeagues.create', ['teams' => Team::all()] , ['leagues' => League::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'league_id' => 'required|exists:leagues,id',
        ]);

        $teamLeague = new TeamLeague();

        $teamLeague->team_id = $request->input('team_id');
        $teamLeague->league_id = $request->input('league_id');
        $teamLeague->save();

        return redirect('/');
    }
    /**
     * Display the specified resource.
     */
    public function show(TeamLeague $teamLeague)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamLeague $teamLeague)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamLeague $teamLeague)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamLeague $teamLeague)
    {
        //
    }
}
