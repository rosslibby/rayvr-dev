<?php

use LaravelBook\Ardent\Ardent;

class Dispute extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'dispute';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = [
		'reimbursement_id',
		'notes',
		'evidence',
		'created_at',
		'updated_at',
	];

	/**
	 * Get the unique identifier for the dispute
	 * 
	 * @var mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the reimbursement that owns the dispute
	 * 
	 * @var integer
	 */
	public function reimbursement()
	{
		return $this->reimbursement_id;
	}
}