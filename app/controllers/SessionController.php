<?php

use RAYVR\Storage\User\UserRepository as User;

class SessionController extends BaseController {

	/**
	 * User Repository
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
	 * Show the form for creating a new Session
	 */
	public function create()
	{
		return View::make('session.create');
	}

	public function register($referral = null)
	{
		if($referral)
			$referral = ['referral' => $referral];
		else
			$referral = ['referral' => ''];

		return View::make('session.index')->with('referral', $referral);
	}

	public function store()
	{
		$input = Input::all();

		$attempt = Auth::attempt([
			'email' => $input['email'],
			'password' => $input['password']
		]);

		if($attempt)
			return Redirect::intended('/');
		return Redirect::to('login')->with('error', 'Your email/password combination was incorrect.');
	}

	public function destroy()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}