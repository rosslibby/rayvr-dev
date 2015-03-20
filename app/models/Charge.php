<?php

use LaravelBook\Ardent\Ardent;

class Charge extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'charge';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'charge_id',
		'card_id',
		'charge',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the charge
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user who was charged
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}
}