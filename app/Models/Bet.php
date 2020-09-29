<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = ['match_id', 'receipt_id', 'team_id', 'user_id', 'bet_sum'];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
