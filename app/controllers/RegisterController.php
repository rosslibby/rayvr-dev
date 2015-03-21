<?php

use RAYVR\Storage\User\UserRepository as User;
use RAYVR\Storage\Category\CategoryRepository as Category;

class RegisterController extends BaseController {

	/**
	 * User Repository
	 */
	protected $user;

	/**
	 * Category Repository
	 */
	protected $category;

	/**
	 * Inject the User Repository
	 * Inject the Category Repository
	 */
	public function __construct(User $user, Category $category)
	{
		$this->user = $user;
		$this->category = $category;
	}

	public function early($referral = null)
	{
		if($referral)
			$referral = ['referral' => $referral];
		else
			$referral = ['referral' => ''];

		return View::make('register.early')->with('referral', $referral);
	}

	public function index($referral = null)
	{
		if($referral)
			$referral = ['referral' => $referral];
		else
			$referral = ['referral' => ''];

		return View::make('landing.home')->with('referral', $referral);
	}

	public function earlyStore()
	{
		/**
		 * Set email as a session variable
		 * so the user can save preferences
		 * without logging in
		 */

		$s = $this->user->createEarly(Input::all());

		if($s)
		{
			Session::put('new_user', $s->id);
			
			/**
			 * Log the user in manually
			 */
			Auth::once(['email' => $s->email, 'password' => $s->password]);
			
			return Redirect::route('user.preferences')
				->with('flash', 'The new user has been created');
		}

		return Redirect::route('register.early')
			->withInput()
			->withErrors($s->errors());
	}

	public function store()
	{
		$s = $this->user->create(Input::all());

		if($s[0])
		{
			Session::put('new_user', $s[1]->id);
			Auth::login($s[1]);

			/**
			 * Determine the redirect based on
			 * whether this is a user or
			 * business registration
			 */
			$route = 'preferences';

			if(Input::get('business') == 'true')
			{
				// temporarily show just the business 'welcome' page
				//$route = 'business.preferences';
				$route = '/';
			}

			return Redirect::to($route)
				->with('flash', 'The new user has been created');
		}

		if(Input::get('business'))
		{
			return Redirect::route('session.register')
				->withInput()
				->with('error', $s[1]);
		}
		return Redirect::route('session.register')
			->withInput()
			->with('error', $s[1]);
	}

	/**
	 * Welcome the new user
	 */
	public function welcome()
	{
		/**
		 * Send the welcome email
		 */
		$user = $this->user->find(Session::get('new_user'));
		Mail::send('emails.welcome', ['name' => Session::get('name'), 'from' => 'The RAYVR team', 'code' => $user->invite_code], function($message) use ($user)
		{
			$message->to($user->email)->subject('Welcome to RAYVR!');
		});

		return View::make('register.welcome', array('name' => Session::pull('name')));
	}

	/**
	 * Welcome the new business
	 */
	public function welcomeBusiness()
	{
		/**
		 * Send the welcome email
		 */
		$user = $this->user->find(Session::get('new_user'));
		Mail::send('emails.business-welcome', ['name' => Session::get('name'), 'from' => 'The RAYVR team'], function($message) use ($user)
		{
			$message->to($user->email)->subject('Welcome to RAYVR!');
		});

		return View::make('register.welcome-business');
	}
}