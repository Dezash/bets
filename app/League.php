<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable = ['name', 'wins', 'losses', 'ties', 'sport_id'];

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function teams()
    {
        return $this->hasMany('App\Team');
    }
}
