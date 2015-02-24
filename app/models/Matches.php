<?php

use LaravelBook\Ardent\Ardent;

class Matches extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'matches';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = array('user_id', 'business_id', 'offer_id', 'category_id', 'live', 'accept');

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
	 * Get the user who owns the match
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get the offer the user is matched to
	 * 
	 * @var integer
	 */
	public function offer()
	{
		return $this->belongsTo('Offer');
	}

	/**
	 * Get whether the offer has been accepted
	 * 
	 * @var boolean
	 */
	public function accept()
	{
		return $this->accept;
	}

	/**
	 * Get when the match is relevant
	 * 
	 * @var integer
	 */
	public function live()
	{
		return $this->live;
	}
}