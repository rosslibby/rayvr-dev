<?php

use LaravelBook\Ardent\Ardent;

class Category extends Ardent {

	/**
	 * The database used by the model
	 * 
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * Allow for mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = array('title');

	/**
	 * Deny for mass assignment
	 * 
	 * @var array
	 */
	protected $guarded = array('count');

	/**
	 * Get the unique identifier for the category
	 * 
	 * @return integer
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the title of the category
	 * 
	 * @return string
	 */
	public function title()
	{
		return $this->title;
	}

	/**
	 * User category relationship
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * User interests relationship
	 */
	public function interests()
	{
		return $this->belongsToMany('User', 'interest', 'cat_id', 'user_id');
	}

	/**
	 * Offer categories relationship
	 */
	public function categories()
	{
		return $this->belongsToMany('Offer', 'offer_categories', 'offer_id', 'category_id');
	}

}