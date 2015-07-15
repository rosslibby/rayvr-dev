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
	 * Initiate Lob
	 */
	protected $lob;

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
		$lob = new \Lob\Lob($_ENV['lob_api_key']);
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
		/**
		 * Save the preferences
		 */
		$user = Auth::user();
		$preferences = Input::all();
		$this->preference->preferences($preferences, Auth::user());

		$user->fill($preferences);
		$user->save();

		/**
		 * Return AJS succuss
		 */
        return Response::json(array('success' => true));
	}

	/**
	 * Store the User preferences
	 */
	public function storeUser()
	{
		$preferences = Input::except(['_token', 'interest']);

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
		 * Send the post card if the account
		 * is unverified
		 */
		//$this->preference->postcard($user);

		/**
		 * Add new interests and
		 * remove any old interests
		 * if the form isn't autosaving
		 */

		if(Input::has('interest'))
		{
		$interests = Input::only('interest');
		$this->preference->setInterests($user, $interests);
		}

		//$user->save();

		/**
		 * Return AJS succuss
		 */
        //return Response::json(array('success' => true));
		/**
		 * If this is the first time setting
		 * preferences, redirect the user to
		 * 'invite your friends' page
		 * BROKEN BY AUTOSAVE
		 */
		// if(!$user->times_updated)
		// {
		// 	$user->times_updated = 1;
		// 	$user->save();
		// 	return Redirect::route('invite')
		// 		->with('success', 'Your account set is complete.');
		// }
		// else
		// {
		// 	$user->times_updated = (int)($user->times_updated) + 1;
		// 	$user->save();
		// }

		if($user->save())
		{
			if($validator)
				return Redirect::route('user.preferences')
					->with('success', 'Your preferences have been updated');
			else
				return Redirect::to('user.preferences')
					->with('success', 'You missed a few fields yo');
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