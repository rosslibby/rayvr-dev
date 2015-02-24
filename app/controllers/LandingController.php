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
	public function index($referral = null)
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
		{
			if(Auth::user()->business)
			{
				if(Auth::user()->address && Auth::user()->email && Auth::user()->first_name && Auth::user()->last_name && Auth::user()->zip && Auth::user()->phone)
				{
					return Redirect::to('offers/track');
				}
				else
				{
					if(Auth::user()->stripe_plan == NULL)
						return Redirect::to('payments');
					else
						return Redirect::to('settings');
				}
			}
			else
			{
				return Redirect::to('offers/current');
			}
		}
		else
		{
			return View::make('landing.home')->with('referral', $referral);
		}
	}

	/**
	 * Direct any user to the contact
	 * page
	 */
	public function contact()
	{
		return View::make('landing.contact');
	}
}