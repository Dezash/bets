<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['match_start', 'match_end', 'first_team', 'second_team', 'first_team_score', 'second_team_score'];
}
