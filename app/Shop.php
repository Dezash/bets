<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['city_id', 'address', 'phone', 'email', 'opening_time', 'closing_time', 'department_id'];
}
