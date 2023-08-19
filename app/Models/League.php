<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    public function teamL() {
        return $this->belongsTo(TeamLeague::class, 'league_id', 'id');
    }
}
