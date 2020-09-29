<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
        //return $value->todatestring();
    }

    protected $fillable = ['first_name', 'last_name', 'birth_date'];

    public static function fromArray($data)
    {
        $instance = new self();
        foreach ($data as $key => $value) {
            $instance->$key = $value;
        }
        return $instance;
    }
}
