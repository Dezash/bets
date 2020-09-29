<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = ['match_id', 'receipt_id', 'team_id', 'user_id', 'bet_sum'];
}
