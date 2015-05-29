<?php

use RAYVR\Storage\User\UserRepository as User;
use \Offer, \Affiliate, \Discount;

class AdminController extends BaseController {

	/**
	 * Use User Repository
	 */
	protected $user;

	/**
	 * Inject the User Repository
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Admin control home
	 */
	public function index()
	{
		return View::make('admin.home');
	}

	/**
	 * View user accounts
	 * *No longer used*
	 */
	public function users()
	{
		return View::make('admin.users')
				->with('users', $this->user->all());
	}

	/**
	 * View affiliates
	 */
	public function affiliates()
	{
		return View::make('admin.affiliates')
				->with('affiliates', Affiliate::all());
	}

	/**
	 * Add new affiliate
	 */
	public function newAffiliate()
	{
		/**
		 * Get form data
		 */
		$data = Input::all();

		/**
		 * Create the affiliate
		 */
		$affiliate = $this->user->makeAffiliate($data);
	}

	/**
	 * View user account
	 */
	public function user($id)
	{
		return View::make('admin.user')
				->with('user', $this->user->find($id));
	}

	/**
	 * View offers
	 */
	public function offers()
	{
		return View::make('admin.offers')
				->with('offers', Offer::all());
	}

	/**
	 * View active offers
	 */
	public function active()
	{
		return View::make('admin.offers.active');
	}

	/**
	 * View individual offer
	 */
	public function single($offer)
	{
		return View::make('admin.offers.single')->with('offer', Offer::find($offer));
	}

	/**
	 * Show discount codes
	 */
	public function showDiscounts()
	{
		return View::make('admin.discounts')
				->with('discounts', Discount::all());
	}

	/**
	 * Set discount code
	 */
	public function discounts()
	{
		$d = $this->user->makeDiscount(Input::all());
		return View::make('admin.discounts')
				->with('success', 'Discount #'.$d->id.' created successfuly')
				->with('discounts', Discount::all());
	}
}