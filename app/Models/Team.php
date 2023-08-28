<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public function partidosComoLocal()
    {
        return $this->hasMany(Partido::class, 'equipo_local_id');
    }

    public function partidosComoVisitante()
    {
        return $this->hasMany(Partido::class, 'equipo_visitante_id');
    }
    public function league()
    {
        return $this->belongsTo(League::class);
    }
}
