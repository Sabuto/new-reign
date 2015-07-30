<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['name', 'price'];

    public function rank()
    {
        return $this->belongsTo('App\Rank');
    }
}
