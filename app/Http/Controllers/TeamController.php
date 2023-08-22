<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $teams = Team::all();
        return response()->json($teams);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
            'country' => 'required|max:25',
            'img' => 'max:10000',
        ]);

        $team = new Team();

        $team->name = $request->input('name');
        $team->country = $request->input('country');
        $team->img = $request->input('img');
        $team->save();

        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('teams.edit', [
            'team' => $team
            //Si necesito un fk se pone tambien asi, 'niveles' => Nivel::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:25',
            'country' => 'required|max:25',
            'img' => 'max:10000',
        ]);

        $team = Team::find($id);

        $team->name = $request->input('name');
        $team->country = $request->input('country');
        $team->img = $request->input('img');
        $team->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team = Team::find($id);

        $team->delete();
    }
}
