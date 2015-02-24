<?php

use RAYVR\Storage\Order\OrderRepository as OrderRepo;
use RAYVR\Storage\Offer\OfferRepository as Offer;
use RAYVR\Storage\User\UserRepository as User;

class OrderController extends BaseController {

	/**
	 * Use Category repository
	 * Use Offer repository
	 */
	protected $category;
	protected $offer;
	protected $order;
	protected $user;

	/**
	 * Inject the Category repository
	 * Inject the Offer repository
	 */
	public function __construct(Category $category, Offer $offer, OrderRepo $order, User $user)
	{
		$this->category = $category;
		$this->offer = $offer;
		$this->order = $order;
		$this->user = $user;
	}

	public function dispute()
	{
		return $this->order->dispute(Input::get('claim'));
	}

	/**
	 * Save the order confirmation
	 * code
	 */
	public function confirm()
	{
		return $this->order->confirm(Auth::user(), Input::get('confirmation'));
	}

	/**
	 * Save user shipping status
	 */
	public function shipping()
	{
		return $this->order->paidShipping(Auth::user(), Input::get('dollars').'.'.Input::get('cents'));
	}

	/**
	 * Moderate shipping
	 */
	public function moderateShipping()
	{
		return View::make('orders.moderate-shipping')
				->with('claims', $this->order->moderateClaim());
	}

	/**
	 * Approve shipping claim
	 */
	public function approveShipping()
	{
		return $this->order->approveClaim(Input::all());
	}

	/**
	 * Finalize the offer by
	 * saving the review URL
	 */
	public function review()
	{
		return $this->order->review(Auth::user(), Input::get('review'));
	}

	/**
	 * Upload document of proof
	 * for true shipping cost
	 * 
	 * Save the URL in the
	 * 'evidence' column of the
	 * 'dispute' table
	 */
	public function shippingDoc($order)
	{
		return View::make('orders.shipping-proof');
	}

	/**
	 * Save shipping proof
	 * document
	 */
	public function shippingSave($order)
	{
		return $this->order->shippingProof($order, Input::file('document'));
	}
}