<?php namespace RAYVR\Storage\Offer;

use RAYVR\Storage\Category\CategoryRepository as Category;

use Offer;

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
			return "<p>The offer for <em>" . $offer->title . "</em> has been approved.</p>";
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