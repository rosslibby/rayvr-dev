<?php

use RAYVR\Storage\User\UserRepository as User;
use RAYVR\Storage\Category\CategoryRepository as Category;
use RAYVR\Storage\Preference\PreferenceRepository as Preference;
use RAYVR\Storage\Interest\InterestRepository as Interest;

class UserController extends BaseController {

	/**
	 * User Repository
	 * Category Repository
	 * Preference Repository
	 */
	protected $user;

	/**
	 * Inject the User Repository
	 * Inject the Category Repository
	 * Inject the Preference Repository
	 */
	public function __construct(User $user, Category $category, Preference $preference, Interest $interest)
	{
		$this->user = $user;
		$this->category = $category;
		$this->preference = $preference;
		$this->interest = $interest;
	}

	public function index()
	{
		return View::make('user.index');
	}

	public function preferences()
	{
		return View::make('user.preferences');
	}

	/**
	 * User invite page
	 */
	public function invite()
	{
		return View::make('user.invite');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /preferences
	 *
	 * @return Response
	 */
	public function store()
	{
		$preferences = Input::only('first_name', 'last_name', 'prime', 'address', 'address_2', 'city', 'state', 'zip', 'country');
		
		$interests = Input::only('interest');
		$interests = $interests['interest'];

		$s = $this->preference->interests($preferences, $interests);

		/**
		 * Store first name in session variable for
		 * access on the Welcome page
		 */
		Session::put('name', Input::get('first_name'));

		if($s->save())
		{
			return Redirect::route('register.welcome')
				->with('flash', 'The user registration is complete');
		}

		return Redirect::route('user.preferences')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Request a password reset
	 */
	public function requestReset()
	{
		return View::make('user.request-reset');
	}

	/**
	 * Send password reset request
	 */
	public function sendResetRequest()
	{
		$email = Input::get('email');
		$this->user->reset($email);
		return "We have sent you an email containing instructions for resetting your password.<br><a href=\"/\">Return home</a>";
	}

	/**
	 * Reset a user's password
	 */
	public function reset()
	{
		$input = Input::all();
		$user = $this->user->userByEmail($input['email']);
		if($user->invite_code == $input['code'] && $user->confirm == $input['confirm'])
		{
			$user->password = Hash::make($input['password']);
			$user->save();
		}
		return "Your password has been reset";
	}

	/**
	 * Suspend a user
	 */
	public function suspend($id)
	{
		$this->user->suspend($id);
		return Redirect::to('users');
	}

	/**
	 * Delete a user (permanent)
	 */
	public function delete($id)
	{
		$this->user->delete($id);
		return Redirect::to('users');
	}

	/**
	 * Change user account type
	 * (user --> business)
	 * (business --> user)
	 * 
	 * Does not allow to set
	 * account to moderator as
	 * that could be a horrible
	 * accident
	 */
	public function type()
	{
		echo $this->user->type(Input::all());
		return Redirect::to('admin/control');
	}

	/**
	 * Display all user --> offer
	 * matches
	 */
	public function matches()
	{
		return $this->user->currentOffer(Auth::user());
	}

	/**
	 * Accept/decline an offer
	 */
	public function accept()
	{
		return $this->user->accept(Auth::user(), Input::get('match'), Input::get('accept'));
	}
}