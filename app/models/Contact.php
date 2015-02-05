<?php

use LaravelBook\Ardent\Ardent;

class Contact extends Ardent {

	/**
	 * The database table used by the model
	 * 
	 * @var string
	 */
	protected $table = 'contact';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = array('email', 'name', 'message');

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
	public static $rules = [
		'email' => 'required',
		'name' => 'required',
		'message' => 'required',
	];

	/**
	 * Purge redundant data
	 */
	public $autoPurgeRedundantAttributes = true;
}