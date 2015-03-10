<?php

use LaravelBook\Ardent\Ardent;

class Preference extends Ardent {

	/**
	 * The database table used by the model
	 * 
	 * @var string
	 */
	protected $table = 'preferences';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'first_name',
		'last_name',
		'prime',
		'address_1',
		'address_2',
		'city',
		'state_id',
		'zip',
		'country_id',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the preference record
	 * 
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
		'user_id' => 'required',
		'first_name' => 'required',
		'last_name' => 'required',
		/**
		 * Not required until launch
		 * 
		 * 'prime' => 'required',
		 * 'address_1' => 'required',
		 * 'city' => 'required',
		 * 'zip' => 'required',
		 * 'country_id' => 'required'
		 * 
		 */
	);

	/**
	 * Purge redundant data
	 */
	public $autoPurgeRedundantAttributes = true;

	/**
	 * Show user-preference relationship
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}
}