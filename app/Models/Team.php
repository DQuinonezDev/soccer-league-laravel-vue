<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function teamL() {
        return $this->hasOne(TeamLeague::class, 'team_id', 'id');
    }
}
