<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assassination extends Model
{

    protected $dates = ['created_at', 'updated_at', 'next_travel'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
