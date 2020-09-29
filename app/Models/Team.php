<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['league_id', 'name'];

    public function bets()
    {
        return $this->hasMany('App\Models\Bet');
    }

    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }

    public function league()
    {
        return $this->belongsTo('App\Models\League');
    }
}
