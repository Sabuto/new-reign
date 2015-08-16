<?php namespace App;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, Messagable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */

    protected $guarded = ['id'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that are to be mutated into Carbon Instances
     * 
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'crimeTime', 'travelTime'];

    /**
     * Returns the hookers a user has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hookers()
	{
		return $this->belongsToMany('App\Hooker');
	}

    public function messages()
    {
        return $this->belongsToMany('App\Message');
    }

    /**
     * Returns the events belonging to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany('App\News');
    }

    public function assassination()
    {
        return $this->belongsTo('App\Assassination');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function rank()
    {
        return $this->belongsTo('App\Rank');
    }

    /**
     * Is the user an admin?
     *
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->admin;
    }
}
