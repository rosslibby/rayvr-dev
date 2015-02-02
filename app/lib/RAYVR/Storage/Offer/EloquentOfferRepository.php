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