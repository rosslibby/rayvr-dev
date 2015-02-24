<?php

use User;
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
		return View::make('payments.index');
	}

	public function membership()
	{
		return View::make('payments.membership');
	}

	public function subscribe()
	{
		/**
		 * Subscribe to the membership
		 */
		$this->user->subscribe(Input::all(), Auth::user());

		/**
		 * Show a thank-you message
		 */
		return Redirect::to('payments');
	}

	public function offers()
	{
		return View::make('payments.offers')
				->with('packs', $this->offer->offerPacks(Auth::user()));
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