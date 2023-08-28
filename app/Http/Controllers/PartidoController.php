<?php
namespace App\Http\Controllers;

use App\Models\Partido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partidos = Partido::all();
        return response()->json($partidos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementar si es necesario
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'equipo_local_id' => 'required|exists:teams,id',
            'equipo_visitante_id' => 'required|exists:teams,id',
            'liga_id' => 'required|exists:leagues,id',
            'fecha' => 'required|date',
            // Agrega más validaciones según tus necesidades
        ]);

        $partido = Partido::create($request->all());

        return response()->json($partido, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Partido $partido)
    {
        return response()->json($partido);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partido $partido)
    {
        // Implementar si es necesario
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partido $partido)
    {
        $request->validate([
            'fecha' => 'required|date',
            'resultado' => 'nullable|string', // Agrega más validaciones según tus necesidades
        ]);

        $partido->update($request->all());

        return response()->json($partido);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        $partido->delete();

        return response()->json(null, 204);
    }
}
