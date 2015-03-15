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
	 * Leave feedback for the order
	 */
	public function feedback()
	{
		return View::make('offers.feedback')->with('offer', $this->offer->find(Auth::user()->current));
	}

	/**
	 * Save order feedback
	 */
	public function saveFeedback()
	{
		if($this->order->feedback(Input::all(), Auth::user()))
			return Redirect::route('offers.current')->with('success', 'Thanks for your feedback!');
		else
			return Redirect::route('offers.feedback');
	}

	/**
	 * Save the order confirmation
	 * code
	 */
	public function confirm()
	{
		$this->order->confirm(Auth::user(), Input::get('confirmation'));
		return $this->order->paidShipping(Auth::user(), Input::get('cost'));
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
		return View::make('admin.orders.moderate-shipping')
				->with('claims', $this->order->moderateClaim());
	}

	/**
	 * Approve shipping claim
	 */
	public function approveShipping()
	{
		$this->order->approveClaim(Input::all());
		return Redirect::to('shipping/moderate')->with('success', 'Shipping reimbursement has been processed.');
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