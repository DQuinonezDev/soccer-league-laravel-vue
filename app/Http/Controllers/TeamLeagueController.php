<?php

namespace App\Http\Controllers;

use App\Models\TeamLeague;
use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
