<?php

use LaravelBook\Ardent\Ardent;

class Discount extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'discount';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'admin_id',
		'user_id',
		'active',
		'start_date',
		'end_date',
		'quota',
		'unlimited',
		'code',
		'discount',
		'times_used',
		'one_per_user',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the discount
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}