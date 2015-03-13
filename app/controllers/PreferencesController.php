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
	 * Business preferences form
	 */
	public function business()
	{
		$model = Auth::user();
		return View::make('forms.preferences.business')->with(compact('model'));
	}

	/**
	 * User preferences form
	 */
	public function user()
	{
		$model = Auth::user();
		$categories = $this->preference->interestCategories($model);
		return View::make('forms.preferences.user')
					->with(compact('model'))
					->with('categories', $categories);
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

		$this->preference->interests($preferences, $interests);
	
		return Redirect::route('register.welcome')
			->with('flash', 'The user registration is complete');
	}

	/**
	 * Store the Business users' preferences
	 */
	public function storeBusiness()
	{
		$preferences = Input::all();

		/**
		 * Validate input
		 */
		$validator = Validator::make(
			Input::except('business_name', 'address_2'),
			[
				'email' => 'required|unique',
				'first_name' => 'required',
				'last_name' => 'required',
				'address' => 'required',
				'city' => 'required',
				'state' => 'required',
				'zip' => 'required',
				'country' => 'required',
				'phone' => 'required'
			]
		);

		$s = $this->preference->preferences($preferences, Auth::user()->id);

		if($s)
		{
			if($validator)
				return Redirect::route('business.preferences')
					->with('success', 'Your settings have been saved');
			else
				return Redirect::route('business.preferences')
					->with('fail', 'There was an issue saving your preferences - please try again');
		}

		return Redirect::route('user/preferences')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Store the User preferences
	 */
	public function storeUser()
	{
		$preferences = Input::except(['_token', 'interest']);
		$interests = Input::only('interest');

		/**
		 * Validate input
		 */
		$validator = Validator::make(
			Input::except('address_2'),
			[
				'email' => 'required|unique',
				'first_name' => 'required',
				'last_name' => 'required',
				'address' => 'required',
				'city' => 'required',
				'state' => 'required',
				'zip' => 'required',
				'country' => 'required',
				'gender' => 'required'
			]
		);

		/**
		 * Change the string value of gender
		 * to a boolean
		 */

		/**
		 * Save the preferences
		 */
		$user = Auth::user();
		$user->fill($preferences);

		/**
		 * Add new interests and
		 * remove any old interests
		 */
		$this->preference->setInterests($user, $interests);

		if($user->save())
		{
			if($validator)
				return Redirect::route('offers.current')
					->with('flash', 'The user registration is complete');
			else
				return Redirect::to('user/preferences')
					->with('flash', 'The user registration is not complete');
		}

		return Redirect::to('user/preferences')
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