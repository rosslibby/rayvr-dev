<?php

use LaravelBook\Ardent\Ardent;

class Billing extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'billing';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'stripe_id',
		'verified',
		'deleted',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the interest
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user who owns the card
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get whether the card has been verified
	 * as valid and active
	 * 
	 * @var boolean
	 */
	public function verified()
	{
		return $this->verified;
	}

	/**
	 * Get whether the card has been deleted
	 * 
	 * @var boolean
	 */
	public function removed()
	{
		return $this->deleted;
	}
}