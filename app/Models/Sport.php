<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public function leagues(){
        return $this->hasMany('App\Models\League');
    }
}
