<?php

use LaravelBook\Ardent\Ardent;

class Voucher extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'voucher';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'offer_id',
		'code',
		'used',
	];

	/**
	 * Get the unique identifier for the voucher
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the offer that owns the voucher
	 * 
	 * @var integer
	 */
	public function offer()
	{
		return $this->belongsTo('Offer');
	}

	/**
	 * Get the usage status of the voucher
	 * 
	 * @var boolean
	 */
	public function used()
	{
		return $this->used;
	}
}