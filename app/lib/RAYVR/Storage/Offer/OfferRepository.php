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
	 * Verify reviews
	 */
	public function verifyReview();

	/**
	 * Select payment method for promotion
	 */
	public function paymentMethod($id, $promotion);

	/**
	 * Retreive approved offers
	 * starting on a particular
	 * date
	 */
	public function offerStart($date);

	/**
	 * Approve an offer
	 */
	public function approve($id, $exclusivity);

	/**
	 * Deny an offer
	 */
	public function deny($id, $reason);

	/**
	 * Find maximum number of matches
	 * for a new offer
	 */
	public function maxMatches($offer, $business);

	/**
	 * Match user with offer
	 */
	public function matchUser($user, $offer);

	/**
	 * Match users with promotions
	 * every second
	 */
	public function secondMatching();

	/**
	 * Match offer with users
	 * upon initial approval
	 * of the respective offer
	 */
	public function match($offer);

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
	 * Bill business for all 
	 * redeemed offers and their
	 * associated shipping costs
	 */
	public function postpay($offer);

	/**
	 * Charge for offers
	 */
	public function closeOffers();

	/*****************************
	 ** AS OF 03/07/2015 WE ARE **
	 ** NO LONGER CHECKING      **
	 ** WHETHER THE BUSINESS    **
	 ** OWNS ANY NUMBER OF      **
	 ** "OFFER PACKS", AS THIS  **
	 ** OPTION IS BEING REMOVED **
	 ** ENTIRELY                **
	 *****************************/

	// /**
	//  * Process offer-pack purchases
	//  */
	// public function offerPurchase($input);

	// /**
	//  * Get offer pack information
	//  */
	// public function offerPacks($user);
}