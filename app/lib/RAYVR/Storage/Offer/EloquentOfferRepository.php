<?php namespace RAYVR\Storage\Offer;

use RAYVR\Storage\Category\CategoryRepository as Category;

use Offer, Interest, User, Omnipay\Omnipay, Auth, Reimbursement, Mail, Matches, OfferPack, Blacklist, Voucher;

class EloquentOfferRepository implements OfferRepository {

	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;

		/**
		 * Set up Omnipay
		 */
		$gateway = Omnipay::create('Stripe');
		$gateway->setApiKey('sk_test_3YmCSPqFkZCBhSroMCu4QAC0');
		$this->gateway = $gateway;
	}

	public function all()
	{
		return Offer::all();
	}

	public function unmoderated()
	{
		return Offer::where('approved', false)->get();
	}

	public function approved()
	{
		return Offer::where('approved', true)->get();
	}

	public function offerStart($date)
	{
		/**
		 * Build an array of conditions
		 * for selecting the offers
		 * 
		 * These conditions will be as
		 * follow:
		 * approved		= true
		 * start		= $date
		 */
		$conditions = [
			'approved'	=> true,
			'start'		=> $date
		];
		return Offer::where($conditions)->get();
	}

	/**
	 * Approve an offer
	 */
	public function approve($id)
	{
		/**
		 * Retrieve the offer
		 */
		$offer = Offer::find($id);

		/**
		 * Approve the offer
		 */
		$offer->approved = true;

		/**
		 * Save the offer
		 */
		if($offer->save())
		{
			/**
			 * Email the business, notifying that
			 * the offer has been approved
			 * 
			 * Start by setting the business from
			 * which we retrieve the email address
			 */
			$business = User::find($offer->business_id);
			Mail::send('emails.offer-approved', ['name' => $business->first_name.' '.$business->last_name, 'from' => 'The RAYVR team'], function($message) use ($business)
			{
				$message->to($business->email)->subject('Your Offer Has Been Approved');
			});

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
		{
			/**
			 * Email the business, notifying that
			 * the offer has been denied
			 * 
			 * Start by setting the business from
			 * which we retrieve the email address
			 */
			$business = User::find($offer->business_id);
			Mail::send('emails.offer-denied', ['name' => $business->first_name.' '.$business->last_name, 'from' => 'The RAYVR team'], function($message) use ($business)
			{
				$message->to($business->email)->subject('Your Offer Has Been Denied');
			});

			return "<p>The offer for <em>" . $offer->title . "</em> has been denied.</p>";
		}
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

		/**
		 * Find all users that have been
		 * blacklisted from working with
		 * this business for receiving
		 * 2 offers in the past
		 */
		$blacklisted = json_decode(Blacklist::where('business_id', $offer->business_id)
						->where('times',2)->get(['user_id']), true);

		/**
		 * Set up an empty array to store
		 * the blacklisted users' IDs
		 */
		$blacklistArr = [];

		/**
		 * Iterate through $blacklisted
		 * and fetch the ID of each user
		 * to store in the $blacklistArr
		 */
		foreach($blacklisted as $blacklist)
		{
			$userid = $blacklist['user_id'];
			array_push($blacklistArr, $userid);
		}

		/**
		 * Implode $blacklistArr so that
		 * it can be checked against in
		 * the database query
		 */
		$blacklistArr = implode(',', $blacklistArr);

		$users = [];

		$categories = json_decode($offer->category, true);

		/**
		 * Set a user index to help
		 * build the array of user IDs
		 */
		foreach($categories as $category)
		{
			/**
			 * Select all the user IDs
			 * from the
			 * "interests" table where
			 * category matches exist.
			 * If a user has been
			 * blacklisted for the
			 * business (owner of the
			 * offer), remove the user
			 * from the list
			 * 
			 * Store these IDs in an
			 * array $userArr
			 */

			$imploded_users = implode(',', $users);
			$userArr = json_decode(Interest::where('cat_id', $category['id'])
									->whereNotIn('user_id', [$imploded_users])
									->whereNotIn('user_id', [$blacklistArr])
									->get(['user_id']), true);
			if(!empty($userArr))
			{
				foreach($userArr as $newUser)
				{
					$userid = $newUser['user_id'];
					array_push($users, $userid);
				}
			}
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
		 * Step 3:
		 * 
		 * Create the matches
		 * and add them to the
		 * "matches" table
		 * 
		 * Final step:
		 * Take all the matched users 
		 * are not currently in
		 * offers and schedule emails
		 * to them the day the offer
		 * launches
		 * 
		 * If an email is scheduled to
		 * go out before the new offer
		 * begins, do not schedule the
		 * new one
		 * 
		 * If an email is scheduled to
		 * send after the new offer
		 * begins, delete it
		 * 
		 * If user is not currently in
		 * offer, schedule an email to
		 * send on the offer's start
		 * date
		 * 
		 * Make sure to schedule only
		 * enough for the first day of
		 * the offer
		 * 
		 * Find number of days offer
		 * must run for
		 */
		$start_date = strtotime($offer->start);
		$end_date = strtotime($offer->end);

		$days = abs($end_date - $start_date);

		/**
		 * Divide the quota by the
		 * result. This gives us the
		 * number of offers we want to
		 * be claimed on a daily basis
		 */
		$daily_quota = (int)($offer->quota / $days);

		/**
		 * Set a counter to moderate
		 * the number of scheduled
		 * emails
		 */
		$quota = 0;
		foreach($users as $id)
		{
			/**
			 * Fetch the user object
			 * associated with the ID
			 */
			$user = User::find($id);

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
			$match = new Matches();
			$match->offer_id = $offer->id;
			$match->user_id = $user['id'];
			$match->business_id = $offer->business_id;
			$match->save();
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
		 * Set up the array of offer codes
		 */
		$offerCodes = [];
		if(!empty($data['codes']))
		{
			/**
			 * Step 1: Store the file
			 * in /uploads
			 */
			$file = $data['codes'];
			$extension = ".".$file->getClientOriginalExtension();
			$destinationPath = public_path().'/uploads/';
			$filename = $file->getClientOriginalName().$extension;
			$data['codes']->move($destinationPath, $filename);

			/**
			 * Get codes from file
			 */
			$fh = fopen(public_path().'/uploads/'.$filename, 'r');
			while($line = fgets($fh))
			{
				array_push($offerCodes, $line);
			}
			fclose($fh);
			/**
			 * Remove the 'codes' value from
			 * the array
			 */
			unset($data['codes']);

			/**
			 * Set the 'code' value to the
			 * first code in the array
			 */
			$data['code'] = $offerCodes[0];
		} else {
			for($i = 0; $i < (int)($data['quota']); $i++)
			{
				array_push($offerCodes, $data['code']);
			}
		}

		/**
		 * Create the offer
		 */
		$s = Offer::create($data);

		/**
		 * Create the offer codes
		 */
		for($i = 0; $i < (int)($data['quota']); $i++)
		{
			$voucher = [
				'offer_id'	=> $s->id,
				'code'		=> $offerCodes[$i],
			];
			Voucher::create($voucher);
		}

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

	public function kickoff()
	{
		/**
		 * Step 1:
		 * Fetch offers that meet the following criteria:
		 * approved = true
		 * start = today
		 */
		$date = date('Y-m-d');

		$offers = $this->offerStart($date);

		/**
		 * Iterate through $offers to make them active
		 * and schedule their first matches
		 */
		foreach($offers as $offer)
		{
			/**
			 * Determine the offer's overall time-span
			 */
			$timespan = abs(strtotime($offer->end) - strtotime($date)) / 86400;

			/**
			 * Determine the number of offers that must
			 * be accepted daily in order to reach the
			 * offer's quota
			 */
			$daily = (int)($offer->quota / $timespan);

			/**
			 * Make the $daily quota of matches live
			 * where the user is not currently in an
			 * offer
			 * 
			 * Schedule emails to these users
			 */

			 /**
			 * Fetch the matches associated with
			 * the offer
			 *
			 * Don't do more matches than exist
			 */
			$matches = $offer->match;
			$count = $daily;

			if(count($matches) < $daily)
			{
				$count = count($matches);
			}

			for($i = 0; $i < $count; $i++)
			{
				/**
				 * Make the match live
				 */
				$matches[$i]->live = true;

				/**
				 * Save the match
				 */
				$matches[$i]->save();

				/**
				 * Get the user that the match belongs to
				 */
				$user = $matches[$i]->user;

				Mail::send('emails.new-offer', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
				{
					$message->to($user->email)->subject('You have new offers waiting for you!');
				});
			}

			/**
			 * Notify the business that their offer
			 * is now live
			 */

			$user = $offer->business;
			Mail::send('emails.new-offer', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
			{
				$message->to($user->email)->subject('Your Offer Has Started');
			});
		}
	}

	public function distribute()
	{
		$date = date('Y-m-d');
		/**
		 * Step 1:
		 * Fetch all offers that
		 * 
		 *   a) have already started
		 *   b) have not yet ended
		 */
		$offers = Offer::where('end', '>=', $date)
					->where('start', '<', $date)
					->where('approved', true)
					->get();

		/**
		 * If the $offers array returned
		 * anything, proceed
		 */
		if(!empty($offers))
		{
			/**
			 * Iterate through each retrieved offer,
			 * redistributing matches as necessary
			 */
			foreach($offers as $offer)
			{
				/**
				 * Determine the offer's overall time-span
				 */
				$timespan = abs(strtotime($offer->end) - strtotime($offer->start)) / 86400;

				/**
				 * Determine the number of offers that must
				 * be accepted daily in order to reach the
				 * offer's quota
				 */
				$daily = (int)($offer->quota / $timespan);

				/**
				 * Determine how many days have elapsed
				 * since the offer's start
				 */
				$elapsed = abs(strtotime($date) - strtotime($offer->start)) / 86400;

				/**
				 * Determine how many offers __should__ have
				 * been accepted by now
				 */
				$projected = $daily * $elapsed;

				/**
				 * Discover how many offers really have been
				 * accepted
				 */
				$accepted = Matches::where('offer_id', $offer->id)
								->where('live', true)
								->where('accept', true)->get();

				/**
				 * Rebuild $daily using the current day 
				 * ($date) as the starting date and
				 * redistribute as necessary
				 */

				/**
				 * Re-determine $daily
				 */
				$daily = (int)(($offer->quota - count($accepted)) / ($timespan - $elapsed));

				/**
				 * Fetch the offer's matches
				 */
				$matches = Matches::where('offer_id', $offer->id)
								->where('live', false);

				/**
				 * Iterate through the matches. Find
				 * users not currently in offers and
				 * store these in an array.
				 * 
				 * Set the matches of these users to live,
				 * and send emails to those users. Do so
				 * until the $daily quota is met
				 */
				$counter = 0;
				foreach($matches as $match)
				{
					/**
					 * Find the user associated with the match
					 */
					$user = $match->user;

					/**
					 * Check if the user is currently in an
					 * offer
					 */
					if($user->current == NULL && $counter < $daily)
					{
						/**
						 * Set the match to live
						 */
						$match->live = true;

						/**
						 * Save changes to the match
						 */
						$match->save();

						/**
						 * Email the user to notify him or her
						 * of a new offer
						 */
						Mail::send('emails.new-offer', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
						{
							$message->to($user->email)->subject('You have new offers waiting for you!');
						});

						/**
						 * Increment $counter
						 */
						$counter++;
					}
				}
			}
		}
	}

	public function offerPurchase($input)
	{
		$token = $input['stripeToken'];
		$pack = (int)($input['pack']);
		switch($pack)
		{
			case 1:
				$amount = '250.00';
				$count = 50;
				$prime = false;
				break;
			case 2:
				$amount = '450.00';
				$count = 100;
				$prime = false;
				break;
			case 3:
				$amount = '800.00';
				$count = 200;
				$prime = false;
				break;
			case 4:
				$amount = '300.00';
				$count = 50;
				$prime = true;
				break;
			case 5:
				$amount = '530.00';
				$count = 100;
				$prime = true;
				break;
			case 6:
				$amount = '900.00';
				$count = 200;
				$prime = true;
				break;
			default:
				return 'You selected an option that does not exist.';
		}

		$response = $this->gateway->purchase(['amount' => $amount, 'currency' => 'USD', 'token' => $token])->send();

		/**
		 * Creat a new OfferPack
		 */
		$offerPack = new OfferPack();
		$offerPack->prime		= $prime;
		$offerPack->total		= $count;
		$offerPack->used		= 0;
		$offerPack->remaining	= $count;
		$offerPack->cost		= (float)($amount);

		/**
		 * Save the OfferPack
		 */
		$offerPack->save();

		/**
		 * Get the logged in user to assign the
		 * OfferPack to
		 */
		$user = Auth::user();

		/**
		 * Assign the OfferPack to $user
		 */
		$user->offerPack()->save($offerPack);

		return $response;
	}

	public function offerPacks($user)
	{
		/**
		 * Get all offer packs the user has
		 * purchased
		 */
		$packs = $user->offerPack;

		/**
		 * Get number of packs user owns
		 */
		$packTotal = count($packs);

		/**
		 * Discover how many offers total
		 * the user has not used
		 * 
		 * Discover how many unused Prime
		 * offers the user has
		 */
		$offerTotal	= 0;
		$primeTotal = 0;

		/**
		 * Iterate through the offer packs
		 */
		foreach($packs as $pack)
		{
			/**
			 * Add the remaining (unused) offers
			 * from each pack to the $offerTotal
			 */
			$offerTotal += $pack->remaining;

			/**
			 * Determine if the OfferPack is for
			 * Prime or regular
			 * 
			 * If the pack is for Prime, add the
			 * remaining (unused) offers to the
			 * primeTotal
			 */
			if($pack->prime)
				$primeTotal += $pack->remaining;
		}

		/**
		 * Build an array of the OfferPack data
		 */
		$data = [
			'packs'		=> $packs,
			'total'		=> $packTotal,
			'offers'	=> $offerTotal,
			'prime'		=> $primeTotal,
		];

		return $data;
	}
}