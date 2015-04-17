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
		return View::make('session.index')->with('referral', $referral);
	}

	public function store()
	{
		$input = Input::all();

		/**
		 * Remember me
		 */
		$remember = (Input::has('remember')) ? true : false;

		$attempt = Auth::attempt([
			'email' => $input['email'],
			'password' => $input['password'],
		], $remember);

		if($attempt && Auth::user()->active)
			return Redirect::intended('/');
		else if($attempt)
		{
			Auth::logout();
			return Redirect::to('login')->with('error', 'Your account has been suspended. Please contact <a href="/contact">support</a> to reopen it.');
		}
		return Redirect::to('login')->with('error', 'Your email/password combination was incorrect.');
	}

	public function destroy()
	{
		$message = null;
		if(Session::has('success'))
		{
			$message = Session::get('success');
			Auth::logout();
			return Redirect::to('/')->with('success', $message);
		}
		else if(Session::has('fail'))
		{
			$message = Session::get('fail');
			Auth::logout();
			return Redirect::to('/')->with('fail', $message);
		}
		Auth::logout();
		return Redirect::to('/');
	}
}