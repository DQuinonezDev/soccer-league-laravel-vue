<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function leagues()
    {
        return $this->belongsToMany(League::class, 'team_leagues', 'team_id', 'league_id');
    }
}
