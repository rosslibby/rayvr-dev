<?php

class Offer extends Eloquent {

	protected $table = 'offers';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'business_id',
		'photo',
		'title',
		'description',
		'start',
		'end',
		'timeframe',
		'code',
		'quota',
		'prime',
		'link',
		'review_link',
		'male',
		'female',
		'free_shipping',
		'shipping_cost',
		'approved',
		'exclusivity',
		'reason',
		'created_at',
		'updated_at',
	];

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
		return $this->hasMany('Matches');
	}

	/**
	 * Offer <--> order relationship
	 */
/* not sure what this is for so I'm commenting it out
	public function order()
	{
		return $this->belongsToMany('Offer', 'orders', 'offer_id', 'user_id');
	}*/

	/**
	 * Order <--> offer relationship
	 */
	public function orders()
	{
		return $this->hasMany('Order');
	}

	/**
	 * Offer <--> business relationship
	 */
	public function business()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Offer <--> deposit relationship
	 */
	public function deposit()
	{
		return $this->hasOne('Deposit');
	}
}