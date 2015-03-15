<?php

use LaravelBook\Ardent\Ardent;

class Feedback extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'feedback';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'offer_id',
		'user_id',
		'damage',
		'malfunction',
		'description',
		'rate',
		'experience',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the feedback
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user who owns the feedback
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get the offer the feedback is matched to
	 * 
	 * @var integer
	 */
	public function offer()
	{
		return $this->belongsTo('Offer');
	}
}