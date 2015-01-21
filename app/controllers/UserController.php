<?php

use RAYVR\Storage\User\UserRepository as User;
use RAYVR\Storage\Category\CategoryRepository as Category;
use RAYVR\Storage\Preference\PreferenceRepository as Preference;

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
	public function __construct(User $user, Category $category, Preference $preference)
	{
		$this->user = $user;
		$this->category = $category;
		$this->preference = $preference;
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
	 * Store a newly created resource in storage.
	 * POST /preferences
	 *
	 * @return Response
	 */
	public function store()
	{
		$preferences = Input::only('first_name', 'last_name'/** Disabled until site is live:, 'prime', 'address_1', 'address_2', 'city', 'state_id', 'zip', 'country_id'*/);
		
		$interests = Input::only('interest');
		$interests = $interests['interest'];

		/**
		 * Get the new user's id from the entered email
		 */
		$user_id = Session::get('new_user');

		/**
		 * Add the user_id to the input array
		 */
		$userid = ['user_id' => $user_id->id];
		$preferences = array_merge($userid, $preferences);

		$s = $this->preference->create($preferences);

		/**
		 * Store first name in session variable for
		 * access on the Welcome page
		 */
		Session::put('name', Input::get('first_name'));

		/**
		 * Create a user relationship with each
		 * category they are interested in
		 */
		for($i = 0; $i < count($interests); $i++)
		{
			/**
			 * Find category associated with user selection
			 */
			$category = $this->category->find($interests[$i]);

			/**
			 * Create new Interest (user-category relationship)
			 */
			$user_id->interest()->save($category);
		}

		if($s->save())
		{
			return Redirect::route('register.welcome')
				->with('flash', 'The user registration is complete');
		}

		return Redirect::route('user.preferences')
			->withInput()
			->withErrors($s->errors());
	}
}