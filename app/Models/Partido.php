<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = ['equipo_local_id', 'equipo_visitante_id', 'liga_id', 'fecha', 'resultado'];

    public function equipoLocal()
    {
        return $this->belongsTo(Team::class, 'equipo_local_id');
    }

    public function equipoVisitante()
    {
        return $this->belongsTo(Team::class, 'equipo_visitante_id');
    }

    public function liga()
    {
        return $this->belongsTo(League::class, 'liga_id');
    }
}
