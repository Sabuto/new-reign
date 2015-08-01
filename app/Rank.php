<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Rank extends Model
    {

        protected $fillable = ['name'];

        public function vehicles()
        {
            return $this->hasMany('App\Vehicle');
        }

        public function users()
        {
            return $this->hasMany('App\User');
        }
    }
