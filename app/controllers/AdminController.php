<?php

use RAYVR\Storage\User\UserRepository as User;
use \Offer;

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
	 */
	public function users()
	{
		return View::make('admin.users')
				->with('users', $this->user->all());
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
}