<?php

use LaravelBook\Ardent\Ardent;

class Affiliate extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'affiliate';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user',
		'email',
		'first_name',
		'last_name',
		'website',
		'invite_code',
		'active',
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
}