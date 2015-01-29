<?php

use Illuminate\Auth\UserTrait;
use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laravel\Cashier\BillableTrait;
use Laravel\Cashier\BillableInterface;

class User extends Ardent implements UserInterface, RemindableInterface, BillableInterface {

	use UserTrait, RemindableTrait, BillableTrait;

	protected $dates = ['trial_ends_at', 'subscription_ends_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * Allow for mass assignment
	 */
	protected $fillable = array('email', 'invite_code', 'invited_by');

	/**
	 * Deny for mass assignment
	 */
	protected $guarded = array('id', 'password');

	/**
	 * Get the unique identifier for the user.
	 * 
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password();
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 * 
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
		'email' => 'required'
	);

	/**
	 * Purge redundant data
	 */
	public $autoPurgeRedundantAttributes = true;

	/**
	 * Points relationship (gamification)
	 */
	public function points()
	{
		return $this->hasMany('Points');
	}

	/**
	 * Category relationship
	 */
	public function category()
	{
		return $this->hasMany('Category');
	}

	/**
	 * User categories relationship
	 */
	public function interest()
	{
		return $this->belongsToMany('Category', 'interest', 'user_id', 'cat_id');
	}

	/**
	 * User preferences relationship
	 */
	public function preference()
	{
		return $this->belongsTo('Preference', 'preferences', 'user_id');
	}
}