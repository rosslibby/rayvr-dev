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
			if(Auth::user()->business && Auth::user()->active == 1)
			{
				if(Auth::user()->address && Auth::user()->email && Auth::user()->first_name && Auth::user()->last_name && Auth::user()->zip && Auth::user()->country && Auth::user()->phone)
				{
					/**
					 * If the user has no approved offers,
					 * redirect the user to the holding
					 * page  
					 */
					if(!empty(json_decode(Offer::where('business_id',Auth::user()->id)->where('approved',true)->get())))
					{
						/**
						 * If the user has not subscribed to
						 * a membership, direct the user to
						 * the membership page
						 */
						if(!Auth::user()->billing)
							return Redirect::to('billing');
						else
							return Redirect::to('offers/track');
					}
					else
					{
						if(count(Offer::where('business_id',Auth::user()->id)->where(['approved' => false, 'reason' => ''])->get()))
							return Redirect::to('offers/review');
						return Redirect::to('offers/add');
					}
				}
				else
				{
					if(!Auth::user()->address || !Auth::user()->email || !Auth::user()->first_name || !Auth::user()->last_name || !Auth::user()->zip || !Auth::user()->country || !Auth::user()->phone)
						return Redirect::to('settings');
					else if(!Auth::user()->stripe_customer)
						return Redirect::to('billing');
					else
						return Redirect::to('offers/track');
				}
			}
			else if(Auth::user()->business && Auth::user()->active == 3 && Auth::user()->verified)
			{
				return Redirect::to('admin/control');
			}
			else if(Auth::user()->business && Auth::user()->active == 3 && !Auth::user()->verified)
			{
				return Redirect::to('admin/confirm');
			}
			else if(Auth::user()->verified)
			{
				if(Auth::user()->address && Auth::user()->email && Auth::user()->first_name && Auth::user()->last_name && Auth::user()->zip && Auth::user()->country)
					return Redirect::to('offers/current');
				return Redirect::to('preferences');
			}
			else
			{
				/**
				 * Temporarily remove postcard
				 * authentication requirement
				 */
				// if(Auth::user()->postcard_sent)
				// 	return Redirect::to('verify');
				//  return Redirect::to('preferences');
				/**
				 * Require email confirmation
				 * instead of address
				 * confirmation
				 */
				if(!Auth::user()->verified)
				{
					return Redirect::to('verify');
				}
				if(Auth::user()->first_name == '' || Auth::user()->last_name == '' || Auth::user()->address == '' || Auth::user()->country == '' || Auth::user()->city == '' || Auth::user()->zip == '')
				{
					return Redirect::to('preferences');
				}
				return Redirect::to('offers/current');
			}
		}
		else
		{
			return View::make('session.register')->with('referral', $referral);
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