<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hooker extends Model {

	protected $fillable = [
		'name', 'rankNeeded', 'payout', 'visit', 'price', 'special'
	];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
