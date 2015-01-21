<?php

use RAYVR\Storage\User\UserRepository as User;
use RAYVR\Storage\Category\CategoryRepository as Category;
use RAYVR\Storage\Preference\PreferenceRepository as Preference;

class PreferencesController extends BaseController {

	/**
	 * Add User Repository
	 */
	protected $user;

	/**
	 * Add Category Repository
	 */
	protected $category;

	/**
	 * Add Preference Repository
	 */
	protected $preference;

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

	/**
	 * Display a listing of the resource.
	 * GET /preferences
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('user.preferences', array('interests' => $this->category->all()));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /preferences/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('preferences.create');
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

	/**
	 * Display the specified resource.
	 * GET /preferences/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /preferences/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /preferences/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /preferences/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}