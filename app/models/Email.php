<?php

use LaravelBook\Ardent\Ardent;

class Email extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'email';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'id',
		'user_id',
		'confirmation',
		'subject',
		'send_time',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the email
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}