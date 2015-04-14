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

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Setting up Cashier
	 */
	protected $dates = ['trial_ends_at', 'subscription_ends_at'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Allow for mass assignment
	 */
	protected $fillable = [
		'email',
		'password',
		'invite_code',
		'invited_by',
		'first_name',
		'last_name',
		'business',
		'business_name',
		'address',
		'address_2',
		'city',
		'state',
		'zip',
		'country',
		'confirm',
		'active',
		'created_at',
		'updated_at',
		'gender',
		'phone',
		'current',
		'profile',
		'has_email',
		'wants_email',
		'verified',
		'postcard_sent',
	];

	/**
	 * Deny for mass assignment
	 */
	protected $guarded = array('id');

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
		return $this->password;
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
		'email' => 'required',
		'password' => 'required',
		'business' => 'required'
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
		return $this->hasMany('Interest');
	}

	/**
	 * User preferences relationship
	 */
	public function preference()
	{
		return $this->hasOne('Preference');
	}

	/**
	 * User <--> offer relationship
	 */
	public function matches()
	{
		return $this->hasMany('Matches');
	}

	/**
	 * User <--> offer-pack relationship
	 */
	public function offerPack()
	{
		return $this->hasMany('OfferPack');
	}

	/**
	 * Business --> offer relationship
	 * shows all the offers a business
	 * has created
	 */
	public function offers()
	{
		return $this->hasMany('Offer', 'business_id');
	}

	/**
	 * User <--> order relationship
	 */
	public function order()
	{
		return $this->hasMany('Order');
	}

	/**
	 * User <--> blacklist relationship
	 */
	public function blacklist()
	{
		return $this->hasMany('Blacklist');
	}
}