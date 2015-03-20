<?php

use LaravelBook\Ardent\Ardent;

class Blacklist extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'blacklist';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'business_id',
		'times',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the blacklist
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user who owns the blacklist
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get the business associated with the blacklist
	 * 
	 * @var integer
	 */
	public function business()
	{
		return $this->business_id;
	}

	/**
	 * Get the number of times the blacklist has been
	 * triggered
	 * 
	 * @var integer
	 */
	public function times()
	{
		return $this->times;
	}
}