<?php

use LaravelBook\Ardent\Ardent;

class Order extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'orders';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'offer_id',
		'user_id',
		'mail_date',
		'confirmation_number',
		'shipping_claim',
		'reimbursed',
		'disputed',
		'paid_shipping',
		'cost',
		'review',
		'reviewed',
		'completed',
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
	 * Get the user who owns the order
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Get the offer associated with the order
	 * 
	 * @var integer
	 */
	public function offer()
	{
		return $this->belongsTo('Offer');
	}

	/**
	 * Get the order confirmation number
	 * 
	 * @var string
	 */
	public function confirmation()
	{
		return $this->confirmation_number;
	}

	/**
	 * Order <--> reimbursement relationship
	 */
	public function reimbursement()
	{
		return $this->hasOne('Reimbursement');
	}
}