<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['league_id', 'name'];

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }

    public function players()
    {
        return $this->hasMany('App\Player');
    }

    public function league()
    {
        return $this->belongsTo('App\League');
    }
}
