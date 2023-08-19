<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ligas = League::all();
        return response()->json($ligas);
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
    public function show(League $liga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(League $liga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, League $liga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(League $liga)
    {
        //
    }
}
