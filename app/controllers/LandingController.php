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
		 * 
		 * If the user's preferences
		 * have not been completed,
		 * redirect to the
		 * preferences page
		 */
		if(Auth::user())
			if(Auth::user()->business)
				if(Auth::user()->address)
					return Redirect::to('offers/track');
				else
					return Redirect::to('settings');
			else
				return View::make('landing.home');
		else
			return View::make('landing.home');
	}
}