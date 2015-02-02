<?php

use RAYVR\Storage\User\UserRepository as User;

class LandingController extends BaseController {

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
	 * Direct logged in user to the
	 * appropriate dashboard
	 */
	public function index()
	{
		/**
		 * Return business dashboard
		 * if the user is a business
		 * user
		 * 
		 * Otherwise return the user
		 * dashboard
		 */
		if(Auth::user())
			if(Auth::user()->business)
				return View::make('business.index');
			else
				return View::make('landing.home');
		else
			return View::make('landing.home');
	}
}