<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['city_id', 'address', 'phone', 'email', 'opening_time', 'closing_time', 'department_id'];

    public function department()
    {
        return $this->belongsTo(self::class, 'department_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
