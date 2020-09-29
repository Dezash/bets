<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Receipt extends Model
{
    protected $fillable = ['sum', 'paid', 'date_paid'];

    
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getTitleAttribute()
    {
        return $this->id . ' €' . $this->sum . '  ' . $this->created_at;
    }
}
