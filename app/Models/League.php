<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'liga_id');
    }
}
