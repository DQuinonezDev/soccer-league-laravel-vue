<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeagueController extends Controller
{

    public function showTeamsInLeague($id)
    {
        $league = League::findOrFail($id);
        
        $teams = $league->teams->map(function ($team) {
            return $team;
        });
        
        return response()->json($teams);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leagues = League::all();
        return response()->json($leagues);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leagues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
            'img' => 'max:10000',
        ]);

        $league = new League();

        $league->name = $request->input('name');
        $league->img = $request->input('img');
        $league->save();

        return redirect('/');
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
    public function edit($id)
    {
        $league = League::find($id);
        return view('leagues.edit', [
            'league' => $league
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
            'img' => 'max:10000',
        ]);

        $league = League::find($id);

        $league->name = $request->input('name');
        $league->img = $request->input('img');
        $league->save();

        return view("teams.message", ['msg' => "Registro guardado"]);

        return redirect('/');
    }

   

    // Función para generar partidos aleatorios entre equipos
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $league = League::find($id);

        $league->delete();
    }


}
