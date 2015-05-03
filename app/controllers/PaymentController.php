<?php

use \User;
use \Order;
use RAYVR\Storage\User\UserRepository as UserRepo;
use RAYVR\Storage\Offer\OfferRepository as Offer;

class PaymentController extends BaseController {

	protected $offer;
	protected $user;

	public function __construct(Offer $offer, UserRepo $user)
	{
		$this->offer = $offer;
		$this->user = $user;
	}

	public function payments()
	{
		return View::make('payments.index')
				->with('membership', $this->user->membership(Auth::user()));
	}

	public function membership()
	{
		return View::make('forms.payment.card');
	}
 
	public function billing()
	{
		return View::make('forms.payment.card')->with('data', $this->user->stripeData(Auth::user()));
		// return $this->user->postpay($this->offer->find(5));
	}

	public function subscribe()
	{
		/**
		 * Subscribe to the membership
		 */
		return $customer = $this->user->createCustomer(Input::all(), Auth::user());;
	}

	public function offers()
	{
		return View::make('payments.offers')
				->with('packs', $this->offer->offerPacks(Auth::user()));
	}

	/**
	 * Delete a card
	 */
	public function delete($id)
	{
		$this->user->deleteCard($id, Auth::user());
		return Redirect::route('billing');
	}

	/**
	 * Process Stripe payment for
	 * offer packs
	 */
	public function payForOffers()
	{
		/**
		 * Purchase the OfferPack
		 */
		$this->offer->offerPurchase(Input::all());

		/**
		 * Show a thank-you message
		 */
		return View::make('payments.offers')
				->with('packs', $this->offer->offerPacks(Auth::user()))
				->with('confirm', 'Your order has been successfully completed.');
	}
}