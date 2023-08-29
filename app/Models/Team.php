<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
   
    public function homeMatches()
    {
        return $this->hasMany(Matches::class, 'homeTeam_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Matches::class, 'awayTeam_id');
    }

}
