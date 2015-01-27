<?php

class Offer extends \Eloquent {

	protected $table = 'offers';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'photo', 'description', 'start', 'end', 'prime', 'female', 'male', 'link'];

	/**
	 * User categories relationship
	 */
	public function category()
	{
		return $this->belongsToMany('Category', 'offer_categories', 'offer_id', 'category_id');
	}
}