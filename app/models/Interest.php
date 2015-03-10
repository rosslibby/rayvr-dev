<?php

use LaravelBook\Ardent\Ardent;

class Interest extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'interest';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'cat_id',
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
	 * Get the user who owns the interest
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->user_id;
	}

	/**
	 * Get the category the user is interested in
	 * 
	 * @var integer
	 */
	public function category()
	{
		return $this->cat_id;
	}

}