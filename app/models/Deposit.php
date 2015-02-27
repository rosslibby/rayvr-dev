<?php

use LaravelBook\Ardent\Ardent;

class Deposit extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'deposit';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'sum',
		'used',
		'remaining',
		'currency',
		'signature',
		'status',
		'tx',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the deposit
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user that the deposit applies to
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get the sum remaining of the deposit
	 * 
	 * @var integer
	 */
	public function remaining()
	{
		return $this->remaining;
	}

	/**
	 * Get the used portion of the deposit
	 * 
	 * @var integer
	 */
	public function used()
	{
		return $this->used;
	}

	/**
	 * Get the sum of the initial deposit
	 * 
	 * @var float
	 */
	public function sum()
	{
		return $this->sum;
	}
}