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

	public function index($referral = null)
	{
		if($referral)
			$referral = ['referral' => $referral];
		else
			$referral = ['referral' => ''];

		return View::make('register.index')->with('referral', $referral);
	}

	public function store()
	{
		/**
		 * Set email as a session variable
		 * so the user can save preferences
		 * without logging in
		 */

		$s = $this->user->create(Input::all());

		if($s->save())
		{
			Session::put('new_user', $this->user->userByEmail(Input::get('email')));
			
			/**
			 * Log the user in manually
			 */
			Auth::login($s);
			
			return Redirect::route('user.preferences')
				->with('flash', 'The new user has been created');
		}

		return Redirect::route('register.index')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Welcome the new user
	 */
	public function welcome()
	{
		/**
		 * Send the welcome email
		 */
		$user = Session::get('new_user');
		Mail::send('emails.welcome', ['name' => Session::get('name'), 'from' => 'The RAYVR team'], function($message) use ($user)
		{
			$message->to($user->email)->subject('Welcome to RAYVR!');
		});

		return View::make('register.welcome', array('name' => Session::pull('name')));
	}
}