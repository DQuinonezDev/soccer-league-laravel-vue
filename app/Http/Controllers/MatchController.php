<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function createMatches(Request $request)
    {
        try {
            $matchesData = $request->input('matches');
    
            $createdMatches = [];
            foreach ($matchesData as $matchData) {
                $createdMatch = Matches::create([
                    'home_team_id' => $matchData['ida']['home_team_id'],
                    'away_team_id' => $matchData['ida']['away_team_id'],
                ]);
                $createdMatches[] = $createdMatch;
            }
    
            return response()->json($createdMatches, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }






    public function getMatches()
    {
        $matches = Matches::all();
        return response()->json($matches, 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
