<?php namespace RAYVR\Storage\Preference;

use Preference, User, Session, Category;

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
		/**
		 * Get the new user's id from the entered email
		 */
		$user_id = Session::get('new_user');

		/**
		 * Set user preferences
		 */
		$user = User::find($user_id);
		$s = $user->fill($preferences);

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
			$category = Category::find($interests[$i]);

			/**
			 * Build array for interest creation
			 */
			$interest = array_merge(['user_id' => $user_id], ['cat_id' => $category->id]);

			/**
			 * Create new Interest (user-category relationship)
			 */
			$user->interest()->create($interest);
		}

		if($s->save())
			return $s;
		else
			return false;
	}

	/**
	 * This sets up preferences without
	 * associating any user <--> category
	 * relationships (interests)
	 */
	public function preferences($preferences, $user)
	{
		/**
		 * Check if preference record exists.
		 * If true, update
		 * If false, create
		 */
		$pref = User::find($user);
		$pref->fill($preferences);
		$s = $pref->save();

		return $s;
	}
}