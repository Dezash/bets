<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['user_id', 'sum', 'fee', 'bank_account', 'payout_date'];
}
