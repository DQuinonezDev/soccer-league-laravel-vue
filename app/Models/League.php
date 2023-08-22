<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{

    public function teamL() {
        return $this->belongsToMany(Team::class, 'team_leagues', 'league_id', 'team_id');

    }
}
