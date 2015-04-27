<?php namespace RAYVR\Storage\User;
	
interface UserRepository {

	/**
	 * Fetch all users
	 */
	public function all();

	/**
	 * Find a user by primary_key ID
	 */
	public function find($id);

	/**
	 * Find a user by email
	 */
	public function userByEmail($string);

	/**
	 * Create a new user
	 */
	public function create($input);

	/**
	 * Register an early-sign-up user
	 * 
	 * This is different from a
	 * typical registration as the
	 * user does not enter a password
	 * or address
	 */
	public function createEarly($input);

	/**
	 * Delete business credit card
	 */
	public function deleteCard($id, $user);

	/**
	 * Delete user account (permanent)
	 */
	public function delete($id);

	/**
	 * Suspend user account
	 */
	public function suspend($id);

	/**
	 * Deactivate user account
	 */
	public function deactivate($user);

	/**
	 * Modify user account type
	 */
	public function type($input);

	/**
	 * Return matches that have not
	 * been declined
	 * 
	 * @var array
	 */
	public function matches($matches);

	/**
	 * Select offer
	 */
	public function accept($user, $match, $accept);

	/**
	 * Show the current offer page
	 * or, if user is not currently
	 * in an offer, show the select
	 * offer page
	 */
	public function currentOffer($user);

	/**
	 * Get the current offer the user
	 * has not completed
	 */
	public function current($user);

	/**
	 * Get all the user's Stripe
	 * billing information
	 */
	public function stripeData($user);

	/**
	 * Verify that a credit card
	 * is real and active
	 */
	public function verify($customer, $card, $user);

	/**
	 * Subscribe businesses to
	 * memberships
	 */
	public function subscribe($input, $user);

	/**
	 * View user subscription data
	 */
	public function membership($user);

	/**
	 * Cancel membership subscription
	 */
	public function cancelMembership($user);

	/**
	 * Process shipping deposit
	 */
	public function deposit($user, $data);

	/**
	 * Send password reset request
	 */
	public function reset($user);

	/**
	 * Send invite to user from RAYVR
	 */
	public function invite($data, $user);

	/**
	 * Verify user address
	 */
	public function verifyAddress($user, $code);

	/**
	 * Manually generate an affiliate user
	 */
	public function makeAffiliate($data);
}