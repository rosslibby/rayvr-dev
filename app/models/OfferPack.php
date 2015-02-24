<?php

use LaravelBook\Ardent\Ardent;

class OfferPack extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'offerpack';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'prime',
		'total',
		'used',
		'remaining',
		'cost',
		'created_at',
		'updated_at'
	];

	/**
	 * Get the unique identifier for the offer pack
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user who owns the offer pack
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get whether the offer pack is for Prime (R)
	 * or for regular offers
	 * 
	 * @var boolean
	 */
	public function prime()
	{
		return $this->prime;
	}

	/**
	 * Get the total number of offers in the pack
	 * (size of the offer pack)
	 * 
	 * @var integer
	 */
	public function size()
	{
		return $this->total;
	}

	/**
	 * Get the number of offers used from the pack
	 * 
	 * @var integer
	 */
	public function used()
	{
		return $this->used;
	}

	/**
	 * Get the number of offers remaining in the pack
	 * 
	 * @var integer
	 */
	public function remaining()
	{
		return $this->remaining;
	}

	/**
	 * Get the amount paid for the offer pack (excluding
	 * any coupons)
	 * 
	 * @var float
	 */
	public function cost()
	{
		return $this->cost;
	}
}