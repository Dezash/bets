<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['match_start', 'match_end', 'first_team', 'second_team', 'first_team_score', 'second_team_score'];

    public function getTitleAttribute()
    {
        return $this->firstTeam->name . ' vs ' . $this->secondTeam->name;
    }

    public function firstTeam()
    {
        return $this->belongsTo('App\Models\Team', 'first_team');
    }

    public function secondTeam()
    {
        return $this->belongsTo('App\Models\Team', 'second_team');
    }

    public function winningTeam()
    {
        return $this->belongsTo('App\Models\Team', 'winning_team');
    }
}
