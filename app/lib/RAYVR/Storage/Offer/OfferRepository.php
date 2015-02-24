<?php namespace RAYVR\Storage\Offer;
	
interface OfferRepository {

	/**
	 * Retrieve all offers
	 */
	public function all();

	/**
	 * Retreive unmoderated offers
	 */
	public function unmoderated();

	/**
	 * Retreive approved offers
	 */
	public function approved();

	/**
	 * Retreive approved offers
	 * starting on a particular
	 * date
	 */
	public function offerStart($date);

	/**
	 * Retrieve all categories
	 * associated with anoffer
	 */
	public function allCategories($offers);

	/**
	 * Find a specific offer
	 */
	public function find($id);

	/**
	 * Track an offer's progress
	 */
	public function track($id);

	public function categories($data, $categories, $business);

	public function offers($userid);

	/**
	 * Make an offer live on its
	 * start date
	 */
	public function kickoff();

	/**
	 * Fire off emails and redistribute
	 * offer assignments as necessary
	 */
	public function distribute();

	/**
	 * Process offer-pack purchases
	 */
	public function offerPurchase($input);

	/**
	 * Get offer pack information
	 */
	public function offerPacks($user);
}