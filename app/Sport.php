<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public function league(){
        return $this->hasMany('App\League');
    }
}
