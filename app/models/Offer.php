<?php

class Offer extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'photo', 'description', 'start', 'end', 'prime', 'female', 'male', 'link'];

	/**
	 * Create offer <--> categories relationship
	 */
	public function category()
	{
		$this->belongsToMany('OfferCategory', 'offer_id', 'category_id');
	}
}