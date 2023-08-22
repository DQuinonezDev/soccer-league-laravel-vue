<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function createMatches(Request $request)
    {
        $matchesData = $request->input('matches');
        $createdMatches = Matches::insert($matchesData);
        return response()->json($createdMatches, 201);
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
