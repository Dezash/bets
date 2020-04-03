<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function getCreatedAtAttribute($value)
    {
        return $value->todatestring();
    }


    // protected $dates = [
    //     'birth_date'
    // ];

    // public function __construct(\stdClass $data)
    // {
    //     foreach ($data as $key => $value) {
    //         $this->$key = $value;
    //     }
    // }

    public static function fromArray($data)
    {
        $instance = new self();
        foreach ($data as $key => $value) {
            $instance->$key = $value;
        }
        return $instance;
    }
}
