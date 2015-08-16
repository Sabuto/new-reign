<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'short', 'godfather', 'status', 'cost'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function crimes()
    {
        return $this->hasMany('App\Crime');
    }
}
