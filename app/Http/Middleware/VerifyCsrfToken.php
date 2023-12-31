<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'create-matches',
        'teams',
        'leagues',
        'teamLeagues',
        'matches/*/*',
        'matches/*',
        'matches/generate/*'
         // Agrega aquí las rutas que quieres excluir de la verificación CSRF
    ];
}
