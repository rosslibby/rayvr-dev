<?php

class Referral extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	/**
	 * Generate the code
	 */
	public function code()
	{
		$this->code = bin2hex(openssl_random_pseudo_bytes(16));
	}

	/**
	 * Referral-user relationship
	 */
	public function user()
	{
		$this->belongsTo('User', 'referrals', 'user_id');
	}

}