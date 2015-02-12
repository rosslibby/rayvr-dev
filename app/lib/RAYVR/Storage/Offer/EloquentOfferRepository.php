<?php namespace RAYVR\Storage\Offer;

use RAYVR\Storage\Category\CategoryRepository as Category;

use Offer, Interest, User;

class EloquentOfferRepository implements OfferRepository {

	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	public function all()
	{
		return Offer::all();
	}

	/**
	 * Find all unapproved offers
	 */
	public function unmoderated()
	{
		return Offer::where('approved', false)->get();
	}

	/**
	 * Approve an offer
	 */
	public function approve($id)
	{
		$offer = Offer::find($id);
		$offer->approved = true;
		if($offer->save())
		{
			/**
			 * Match users with the offer
			 */
			$this->match($offer);
			return "<p>The offer for <em>" . $offer->title . "</em> has been approved.</p>";
		}
		return "The offer was not approved. Don't ask me why, I'm just the messenger.";
	}

	/**
	 * Deny an offer
	 */
	public function deny($id)
	{
		$offer = Offer::find($id);
		$offer->approved = false;
		if($offer->save())
			return "<p>The offer for <em>" . $offer->title . "</em> has been denied.</p>";
		return "The offer was not denied. Don't ask me why, I'm just the messenger.";
	}

	/**
	 * Match offer with users
	 * upon initial approval
	 * of the respective offer
	 */
	public function match($offer)
	{
		/**
		 * Step 1:
		 * 
		 * Find each user with
		 * an interest matching
		 * a category
		 * 
		 * Go through each
		 * category until either
		 * the quota has been
		 * met or we run out of
		 * categories
		 * 
		 * Create the array $users
		 * to store the users we
		 * find
		 * 
		 * Store the categories in
		 * an array $categories
		 */

		$users = [];

		$categories = $offer->category;

		foreach($categories as $category)
		{
			/**
			 * Select all the user IDs
			 * from the
			 * "interests" table where
			 * category matches exist.
			 * Store these IDs in an
			 * array $userArr
			 */
			$userArr = Interest::where('cat_id', $category->id)->whereNotIn('user_id', [implode(",", $users)])->get(['user_id']);
			array_push($users, $userArr);
		}

		/**
		 * Step 2:
		 * 
		 * Remove all users whose
		 * gender preferences do
		 * not match those of the
		 * offer
		 * 
		 * **********************
		 * 
		 * Final step:
		 * 
		 * Create the matches
		 * and add them to the
		 * "matches" table
		 */
		foreach($users as $id)
		{
			/**
			 * Extract the integer ID from
			 * the $id array-object
			 */
			$user_id = $id[0]->user_id;

			/**
			 * Fetch the user object
			 * associated with the ID
			 */
			$user = User::find($user_id);

			/**
			 * Check if the gender of $user
			 * matches the preferred gender
			 * for the offer
			 * 
			 * If false, continue to next
			 * $user
			 */

			/**
			 * If the offer requires males
			 * and excludes females, exclude
			 * females
			 * 
			 * Conversely, if the offer
			 *  excludes males and requires
			 * females, exclude males
			 */

			if($offer->male && !$offer->female)
			{
				if($user['gender'])
					continue;
			}
			else if(!$offer->male && $offer->female)
			{
				if(!$user['gender'])
					continue;
			}

			/**
			 * Check if the offer requires
			 * Prime shipping. If true,
			 * check if the user has Prime.
			 * 
			 * If false, continue to next
			 * $user
			 */

			if($offer->prime)
				if(!$user['prime'])
					continue;

			/**
			 * Create the match
			 */
			$offer->match()->save($user);
		}
		return $users;
	}

	/**
	 * Find all categories associated
	 * with each offer passed in through
	 * the $offers array
	 * 
	 * Returns arrays of $offers objects
	 * and their associated categories as
	 * arrays
	 */
	public function allCategories($offers)
	{
		$data = [];
		foreach($offers as $offer)
		{
			/**
			 * Find associated categories
			 */
			$categories = $offer->category;

			/**
			 * Build array of category IDs
			 * and their respective titles
			 */
			$cat = [];
			foreach($categories as $category)
			{
				$title = $this->category->find($category->id)->title;
				$arr = ['id' => $category->id, 'title' => $title];
				array_push($cat, $arr);
			}

			$arr = ['offer' => $offer, 'categories' => $cat];
			array_push($data, $arr);
		}
		return $data;
	}

	public function find($id)
	{
		return Offer::find($id);
	}

	public function track($id)
	{
		return Offer::find($id);
	}

	public function categories($data, $categories, $business)
	{
		/**
		 * Convert the inputted dates to
		 * appropriate date format
		 */
		$data['start'] = date("Y-m-d", strtotime($data['start']));
		$data['end'] = date("Y-m-d", strtotime($data['end']));

		/**
		 * Create the offer
		 */
		$s = Offer::create($data);

		/**
		 * Add currently logged in user for 'business' attribute
		 */
		$s->business_id = $business;

		if($s->save())
		{
			for($i = 0; $i < count($categories); $i++)
			{
				/**
				 * Find category associated with user selection
				 */
				$cat = $this->category->find($categories[$i]);

				/**
				 * Create new Interest (user-category relationship)
				 */

				$s->category()->save($cat);
			}

			return true;
		}
	}

	public function offers($userid)
	{
		return Offer::where('business_id', '=', $userid)->get();
	}
}