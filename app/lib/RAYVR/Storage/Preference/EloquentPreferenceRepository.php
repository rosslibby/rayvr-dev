<?php namespace RAYVR\Storage\Preference;

use Preference;

class EloquentPreferenceRepository implements PreferenceRepository {

	public function all()
	{
		return Preference::all();
	}

	public function find($id)
	{
		return Preference::find($id);
	}

	public function create($input)
	{
		return Preference::create($input);
	}

	public function interests($preferences, $interests)
	{
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
		 * Store first name in a session variable for
		 * access on the Welcome page
		 */
		Session::put('name', $preferences['first_name']);

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
	}
}