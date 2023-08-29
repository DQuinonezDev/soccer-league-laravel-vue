<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'homeTeam_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'awayTeam_id');
    }
    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }
}
