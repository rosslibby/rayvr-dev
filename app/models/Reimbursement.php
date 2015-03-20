<?php

use LaravelBook\Ardent\Ardent;

class Reimbursement extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'reimbursement';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'offer_id',
		'cost',
		'response',
		'resolved',
		'dispute',
		'created_at',
		'updated_at',
	];

	/**
	 * Get the unique identifier for the reimbursement
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the user who owns the reimbursement
	 * 
	 * @var integer
	 */
	public function user()
	{
		return $this->user_id;
	}

	/**
	 * Get the order associated with the reimbursement
	 * 
	 * @var integer
	 */
	public function order()
	{
		return $this->belongsTo('Order');
	}

	/**
	 * Reimbursement <--> dispute relationship
	 */
	public function disputed()
	{
		return $this->hasOne('Dispute');
	}
}