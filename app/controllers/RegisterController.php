<?php

use RAYVR\Storage\User\UserRepository as User;
use RAYVR\Storage\Category\CategoryRepository as Category;
use Hashids\Hashids as Hashids;

class RegisterController extends BaseController {

	protected $hashids;

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
	public function __construct(User $user, Category $category, Hashids $hashids)
	{
		$this->user = $user;
		$this->category = $category;
		$this->hashids = $hashids;
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
		 * Set up the user's new referral code
		 */
		$code = $this->hashids->encode(1);

		/**
		 * Set email as a session variable
		 * so the user can save preferences
		 * without logging in
		 */

		$s = $this->user->create(Input::all(), $code);

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
		return View::make('register.welcome', array('name' => Session::pull('name')));
	}
}