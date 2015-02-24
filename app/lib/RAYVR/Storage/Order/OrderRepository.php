<?php namespace RAYVR\Storage\Order;

interface OrderRepository {

	public function all();

	public function find($id);

	public function create($input);

	/**
	 * Returns all claimed offers
	 */
	public function orders($id);

	/**
	 * Returns all ordered offers
	 * as determined by having an
	 * order confirmation code
	 */
	public function ordered($orders);

	/**
	 * Returns all orders that have
	 * been reviewed
	 */
	public function reviews($orders);

	/**
	 * Returns all orders that have
	 * associated shipping claims
	 */
	public function shipping($orders);

	/**
	 * Return all the data
	 * about the offer
	 */
	public function data($id);

	/**
	 * Let user place claim for
	 * shipping reimbursement
	 */
	public function paidShipping($user, $cost);

	/**
	 * Moderate a users's shipping
	 * reimbursement claim
	 */
	public function moderateClaim();

	/**
	 * Approve a users's shipping
	 * reimbursement claim
	 */
	public function approveClaim($input);

	/**
	 * Create a shipping
	 * reimbursement claim
	 */
	public function claim($user, $order, $cost);

	/**
	 * Dispute a shipping
	 * reimbursement claim
	 */
	public function dispute($claim);

	/**
	 * Confirm an order using
	 * its confirmation code
	 */
	public function confirm($user, $confirmation);

	/**
	 * Complete an order using
	 * its review URL
	 */
	public function review($user, $review);

	/**
	 * Upload shipping proof
	 * document
	 */
	public function shippingProof($order, $document);
}