<?php

class Offer extends Eloquent {

	protected $table = 'offers';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'photo', 'description', 'start', 'end', 'prime', 'female', 'male', 'link'];

	/**
	 * Offer categories relationship
	 */
	public function category()
	{
		return $this->belongsToMany('Category', 'offer_categories', 'offer_id', 'category_id');
	}

	/**
	 * Offer <--> user relationship
	 */
	public function match()
	{
		return $this->belongsToMany('User', 'matches', 'offer_id', 'user_id');
	}

	/**
	 * Offer <--> reimbursement relationship
	 */
	public function reimbursement()
	{
		return $this->belongsToMany('User', 'reimbursement', 'user_id', 'offer_id', 'cost', 'response');
	}
}