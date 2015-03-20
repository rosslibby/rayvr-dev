<?php namespace RAYVR\Storage\Offer;

use RAYVR\Storage\Category\CategoryRepository as CategoryRepo;

use Offer, Interest, User, Omnipay\Omnipay, Auth, Reimbursement, Mail, Matches, OfferPack, Blacklist, Voucher, Category, Copycat, Order, Stripe, DateTime, DateInterval, Charge;

class EloquentOfferRepository implements OfferRepository {

	protected $category;
	protected $user;
	protected $order;

	public function __construct(CategoryRepo $category, User $user, Order $order)
	{
		$this->category = $category;
		$this->user = $user;
		$this->order = $order;

		/**
		 * Set up Omnipay
		 */
		$gateway = Omnipay::create('Stripe');
		$gateway->setApiKey('sk_test_3YmCSPqFkZCBhSroMCu4QAC0');
		$this->gateway = $gateway;

		Stripe::setApiKey($_ENV['stripe_api_key']);
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

	public function verifyReview()
	{
		/**
		 * Initiate array to store all reviews that we
		 * run in
		 */
		$reviews = [];

		/**
		 * Find all orders with reviews that have been
		 * submitted and not verified
		 */
		$orders = Order::where('review',true)->where('completed',false)->get();
		foreach($orders as $order)
		{
			/**
			 * Get the review text as submitted by the user
			 */
			// $review = $order->review;

			/**
			 * Get the user's review profile
			 */
			$profile = $order->user->profile;
			$profile = explode('/', $profile);
			$profile = 'http://www.amazon.com/gp/cdp/member-reviews/'.end($profile).'/ref=pdp_new';

			/**
			 * Get the offer's title
			 */
			$title = $order->offer->title;

			/**
			 * Get the review page link as submitted by the business
			 */
			// $url = Offer::where('id','=',$order->offer_id)->get(['review_link'])[0]->review_link;

			/**
			 * Remove ending punctuation from $review
			 */
			// $review = substr($review, 0, strlen($review) - 1);

			/**
			 * Make sure the review page is sorted by descending order
			 * according to date posted
			 */
			// if(substr($url, -34) != '&sortBy=bySubmissionDateDescending')
			// {
			// 	$copyUrl = $url;
			// 	if(strstr($copyUrl, '&sortBy='))
			// 	{
			// 		$url = explode('&sortBy=',$url);
			// 		$url = $url[0];
			// 	}
			// 	$url = $url.'&sortBy=bySubmissionDateDescending';
			// }

			/**
			 * Start ye old page scraper
			 */
			$cc = new Copycat;
			$cc->setCURL([
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
				CURLOPT_PROGRESSFUNCTION => 'callback'
			]);

			$text = '#'.str_replace('/', '/', preg_quote($title)).'#';

			$cc->match([
				'review' => $text
			])->URLs($profile);

			/**
			 * Return an array of the data
			 */
			$result = [
				'review' => $cc->get()[0]['review']
			];

			if($cc->get()[0]['review'])
			{
				array_push($reviews, $cc->get()[0]['review']);

				/**
				 * Set the order as completed
				 */
				$order->completed = true;
				$order->save();
			}
			else
				array_push($reviews, 'fail');
		}
		return $reviews;
	}

	public function paymentMethod($id, $promotion)
	{
		$promotion->billing = $id;
		return $promotion->save();
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
	public function approve($id, $exclusivity)
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
		 * Grant exclusivity to the offer
		 */
		$offer->exclusivity = $exclusivity;

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

			/**
			 * Until we set up a category exclusivity
			 * specification system...
			 */
			$category = $exclusivity;
			Mail::send('emails.offer-approved', ['name' => $business->first_name.' '.$business->last_name, 'from' => 'The RAYVR team', 'category' => $category], function($message) use ($business)
			{
				$message->to($business->email)->subject('Your Offer Has Been Approved');
			});

			/**
			 * Match users with the offer
			 */
			return $this->match($offer);
			return "<p>The offer for <em>" . $offer->title . "</em> has been approved.</p>";
		}
		return "The offer was not approved. Don't ask me why, I'm just the messenger.";
	}

	/**
	 * Deny an offer
	 */
	public function deny($id, $reason)
	{
		$offer = Offer::find($id);
		$offer->approved = false;
		$offer->reason = $reason;
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
			Mail::send('emails.offer-denied', ['name' => $business->first_name.' '.$business->last_name, 'from' => 'The RAYVR team', 'reason' => $reason], function($message) use ($business)
			{
				$message->to($business->email)->subject('Your Offer Has Been Denied');
			});

			return "<p>The offer for <em>" . $offer->title . "</em> has been denied.</p>";
		}
		return "The offer was not denied. Don't ask me why, I'm just the messenger.";
	}

	public function maxMatches($offer, $business)
	{
		/**
		 * Returns $maxCount which shows
		 * how many users are eligible
		 * for the new offer
		 */
		$maxCount = 0;

		/**
		 * Find all users that have been
		 * blacklisted from working with
		 * this business for receiving
		 * 3 offers in the past
		 */
		$blacklisted = json_decode(Blacklist::where('business_id', $business->id)
						->where('times',3)->get(['user_id']), true);

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
		 * Add any users - who have received
		 * this product before through a
		 * different promotion - to the
		 * blacklist
		 */
		$asin = json_decode(Order::where('asin', $offer['asin'])->get(['user_id']), true);

		if(!empty($asin))
		{
			foreach($asin as $blacklist)
			{
				$userid = $blacklist['user_id'];
				array_push($blacklistArr, $userid);
			}
		}

		/**
		 * Implode $blacklistArr so that
		 * it can be checked against in
		 * the database query
		 */
		$blacklistArr = implode(',', $blacklistArr);

		$users = [];

		$categories = Category::whereIn('id', $offer['interest'])->get();

		$userArr = User::whereNotIn('id', [$blacklistArr])->get();
		if(!empty($userArr))
		{
			foreach($userArr as $user)
			{
				/**
				 * Make sure the user's gender
				 * does not conflict with the
				 * offer's parameters
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

				if(array_key_exists('female', $offer) && array_key_exists('male', $offer))
				{
					if($offer['male'] && !$offer['female'])
					{
						if($user->gender)
							break;
					}
					else if(!$offer['male'] && $offer['female'])
					{
						if(!$user->gender)
							break;
					}
				}
				else if(array_key_exists('female', $offer))
				{
					if($offer['female'])
					{
						if(!$user->gender)
							break;
					}
				}
				else
				{
					if($offer['male'])
					{
						if($user->gender)
							break;
					}
				}

				/**
				 * Find any categories the $user
				 * has in common with the $offer
				 */
				foreach($user->interest as $interest)
				{
					$common = false;
					foreach($categories as $category)
					{
						if($category->id == $interest->cat_id)
						{
							$common = true;
							$maxCount++;
							break 2;
						}
					}
				}
			}
		}

		return $maxCount;
	}

	public function matchUser($user, $offer)
	{
		/**
		 * Make sure the user's gender
		 * does not conflict with the
		 * offer's parameters
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
			if($user->gender)
				return;
		}
		else if(!$offer->male && $offer->female)
		{
			if(!$user->gender)
				return;
		}

		/*****************************
		 ** AS OF 03/07/2015 WE ARE **
		 ** NO LONGER CHECKING      **
		 ** WHETHER BUSINESS        **
		 ** PREFERS PRIME USERS, AS **
		 ** THIS OPTION IS BEING    **
		 ** REMOVED ENTIRELY        **
		 *****************************/

		// *
		//  * Check if the offer requires
		//  * Prime shipping. If true,
		//  * check if the user has Prime.
		//  * 
		//  * If false, continue to next
		//  * $user
		 

		// if($offer->prime)
		// 	if(!$user->prime)
		// 		return;

		/**
		 * Find any categories the $user
		 * has in common with the $offer
		 */
		$common = false;
		foreach($user->interest as $interest)
		{
			if(json_decode($offer->category()->where('category_id', $interest->cat_id)->get(), true))
			{
				/**
				 * If the user shares a category
				 * with the offer, they have
				 * something in common and can
				 * exit this loop
				 */
				$common = true;
				break;
			}
		}

		/**
		 * Check for conflicting addresses
		 */
		$conflict = false;
		if($common)
		{
			$address = [
				'address'	=> $user->address,
				'address_2'	=> $user->address_2,
				'city'		=> $user->city,
				'state'		=> $user->state,
				'zip'		=> $user->zip,
				'country'	=> $user->country,
			];

			$orders = $offer->orders;
			foreach($orders as $order)
			{
				if($order->user()->where($address)->get())
				{
					$conflict = true;
				}
			}
		}

		if(!$conflict)
		{
			/**
			 * Determine whether the user has
			 * been matched with this offer
			 * in the past
			 * 
			 * Also determine whether the
			 * user is a business. Businesses
			 * shoul never be matched with
			 * offers
			 */
			$criteria = [
				'user_id' => $user->id,
				'offer_id' => $offer->id,
			];
			$match = json_decode(Matches::where($criteria)->get(), true);
			$foundMatch = false;
			foreach($match as $conflictingMatch)
			{
				if($conflictingMatch)
					$foundMatch = true;
			}
			if(!$foundMatch && !$user->business)
			{
				$match = new Matches();
				$match->offer_id = $offer->id;
				$match->user_id = $user->id;
				$match->business_id = $offer->business_id;
				$match->save();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}

		return $user;
	}

	/**
	 * Match users with promotions
	 * every second of the day
	 */
	public function secondMatching()
	{
		/**
		 * Determine today's date
		 */
		$date = date('Y-m-d');

		/**
		 * Select all promotions that
		 * have not yet ended and
		 * have been approved and
		 * have selected billing
		 * information
		 */
		$promotions = Offer::where('end', '>=', $date)
						->where('approved', true)
						->where('billing', true)
						->get();

		/**
		 * Iterate through promotions
		 * to find users that match
		 * each promotion's attributes
		 */
		foreach($promotions as $promo)
		{
			/**
			 * Select the offer's gender
			 * preference (if any)
			 */
			$male = $promo->male;
			$female = $promo->female;

			/**
			 * Set up the gender that
			 * the user should NOT match
			 */
			$bad = null;
			if(($male && $female) || (!$male && !$female))
			{
				$bad = 2;
			}
			else
			{
				if($male)
				{
					$bad = 0;
				}
				else
				{
					$bad = 1;
				}
			}

			/**
			 * Select the categories
			 */
			$categories = $promo->category;

			/**
			 * Build the blacklist of users
			 * that have already done ordered
			 * from this business 3 times
			 */
			$blacklisted = json_decode(Blacklist::where('business_id', $promo->business_id)
												->where('times', 3)
												->get(['user_id']), true);
			$blacklistArr = [];
			foreach($blacklisted as $blacklist)
			{
				$userid = $blacklist['user_id'];
				array_push($blacklistArr, $userid);
			}
			$blacklistArr = implode(',', $blacklistArr);

			/**
			 * Find all the users that
			 * match the promo's criteria
			 */
			$users = [];
			$userArr = User::whereNotInt('id', [$blacklistArr])
							->where('gender', '!=', $bad)
							->where('current', false)
							->get();

			/**
			 * Create the matches
			 */
			$unique = [];
			foreach($userArr as $user)
			{
				/**
				 * Assume the user has no
				 * interests in common with
				 * the promotion
				 */
				$common = false;

				/**
				 * Iterate through the user's
				 * interests in hopes of
				 * discovering a common
				 * interest
				 */
				foreach($user->interest as $interest)
				{
					foreach($categories as $category)
					{
						if($interest->cat_id == $category->category_id)
						{
							$common = true;
							break 2;
						}
					}
				}

				/**
				 * Check for conflicting
				 * addresses
				 */
				$conflict = false;

				if($common)
				{
					$address = [
						'address'	=> $user->address,
						'address_2'	=> $user->address_2,
						'city'		=> $user->city,
						'state'		=> $user->state,
						'zip'		=> $user->zip,
						'country'	=> $user->country,
					];

					/**
					 * Find all orders associated
					 * with the offer thus far to
					 * check the addresses against
					 */
					$orders = $promo->orders;

					foreach($orders as $order)
					{
						if($order->user()->where($address)->get())
						{
							$conflict = true;
						}
					}
				}

				if(!$conflict)
				{
					/**
					 * Determine whether the user has
					 * been matched with this offer
					 * in the past
					 * 
					 * Also determine whether the
					 * user is a business. Businesses
					 * should never be matched with
					 * offers
					 */
					$criteria = [
						'user_id' => $user->id,
						'offer_id' => $promo->id,
					];
					$match = json_decode(Matches::where($criteria)->get(), true);
					$foundMatch = false;
					if(!empty($match))
					{
						foreach($match as $conflictingMatch)
						{
							$foundMatch = true;
						}
					}

					if(!$foundMatch && !$user->business)
					{
						$match = new Matches();
						$match->offer_id = $promo->id;
						$match->user_id = $user->id;
						$match->business_id = $promo->business_id;
						$match->save();
					}
				}
			}
		}
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
		 * 3 offers in the past
		 */
		$blacklisted = json_decode(Blacklist::where('business_id', $offer->business_id)
						->where('times',3)->get(['user_id']), true);

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

		$userArr = User::whereNotIn('id', [$blacklistArr])->get();
		if(!empty($userArr))
		{
			foreach($userArr as $newUser)
			{
				$matched = $this->matchUser($newUser, $offer);
				if($matched)
				{
					array_push($users, $matched);
				}
			}
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
			if(!array_key_exists('quota', $data))
				$data = array_merge($data, ['quota' => 15]);
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

			/*****************************
			 ** AS OF 03/07/2015 WE ARE **
			 ** NO LONGER CHECKING      **
			 ** WHETHER BUSINESS        **
			 ** PREFERS PRIME USERS OR  **
			 ** WHETHER THE BUSINESS    **
			 ** OWNS ANY NUMBER OF      **
			 ** "OFFER PACKS", AS BOTH  **
			 ** OF THESE OPTIONS ARE    **
			 ** BEING REMOVED ENTIRELY  **
			 *****************************/

			// /**
			//  * Check if user selected Prime exclusivity
			//  * 
			//  * If false, notify the user that they will
			//  * have to pay a shipping deposit of
			//  * $quota * rate
			//  * 
			//  * Check if user has enough available offers
			//  * to cover the $quota; if not, prompt the
			//  * user to purchase more offers
			//  */
			// $packs = $s->business->offerPack()
			// 			->where('prime', $s->prime)
			// 			->where('remaining', '!=', 0)
			// 			->get();
			// $offerCount = 0;
			// $packIter = 0;

			// /**
			//  * Check if the user has any offer packs
			//  * whatsoever
			//  */
			// if(!empty(json_decode($packs)))
			// {
			// 	while($packIter < (count($packs) - 1))
			// 	{
			// 		$offerCount += $packs[$packIter]->remaining;
			// 		$packIter++;
			// 	}
			// }

			/**
			 * Email the business informing them of
			 * the approval process
			 */

			$user = User::find($business);

			Mail::send('emails.offer-submitted', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
			{
				$message->to($user->email)->subject('Your offer has been submitted!');
			});

			/*****************************
			 ** AS OF 03/07/2015 WE ARE **
			 ** NO LONGER CHECKING      **
			 ** WHETHER BUSINESS        **
			 ** PREFERS PRIME USERS OR  **
			 ** WHETHER THE BUSINESS    **
			 ** OWNS ANY NUMBER OF      **
			 ** "OFFER PACKS", AS BOTH  **
			 ** OF THESE OPTIONS ARE    **
			 ** BEING REMOVED ENTIRELY  **
			 *****************************/

			$response = [
				'success'	=> 1,
				'message'	=> 'Your offer has been successfully submitted for review. If it is accepted, it will begin on '.date('M. d, Y', strtotime($s->start)).'. No further action is required at this time.',
				'id'		=> $s->id,
			];

			/**
			 * If the business has used the trial
			 * already, direct to the billing page
			 */
			if(count($user->offers) > 1)
			{
				$response = [
					'success'	=> 2,
					'message'	=> 'Your offer has been successfully submitted for review. Please confirm your billing information below.',
					'id'		=> $s->id,
				];
			}
			return $response;

			// if($offerCount >= $s->quota && $s->prime)
			// {
			// 	$response = [
			// 		'success' => 1,
			// 		'message' => 'Your offer has been successfully submitted for review. No further action is required at this point.',
			// 		'prime' => $s->prime,
			// 		'id' => $s->id
			// 	];
			// 	return $response;
			// }
			// elseif($s->prime)
			// {
			// 	$response = [
			// 		'success' => 2,
			// 		'message' => 'You do not have enough offers to send out to '.$s->quota.' users. Please purchase a <strong>Prime<sup>&reg;</sup> offer pack.',
			// 		'prime' => $s->prime,
			// 		'id' => $s->id
			// 	];
			// 	return $response;
			// }
			// elseif($offerCount >= $s->quota && !$s->prime)
			// {
			// 	$shipping_cost = $s->shipping_cost;
			// 	if($shipping_cost)
			// 	{
			// 		$response = [
			// 			'success' => 3,
			// 			'message' => 'You will need to leave a deposit of $'.($s->quota * $shipping_cost).' for shipping costs upon approval of your offer.',
			// 			'prime' => $s->prime,
			// 			'id' => $s->id
			// 		];
			// 	}
			// 	else
			// 	{
			// 		$response = [
			// 			'success' => 3,
			// 			'message' => 'You have indicated that your offer is eligible for free shipping. No further action is required at this time.',
			// 			'prime' => $s->prime,
			// 			'id' => $s->id
			// 		];
			// 	}
			// 	return $response;
			// }
			// else
			// {
			// 	$shipping_cost = $s->shipping_cost;
			// 	if($shipping_cost)
			// 	{
			// 		$response = [
			// 			'success' => 4,
			// 			'message' => 'You will need to purchase more <strong>regular (non-Prime<sup>&reg;</sup>)</strong>  offers to send to '.$s->quota.' users. Once your offer has been approved, you will need to leave a deposit of $'.($s->quota * $s->shipping_cost).' for shipping costs.',
			// 			'prime' => $s->prime,
			// 			'id' => $s->id
			// 		];
			// 	}
			// 	else
			// 	{
			// 		$response = [
			// 			'success' => 4,
			// 			'message' => 'You will need to purchase more <strong>regular (non-Prime<sup>&reg;</sup>)</strong>  offers to send to '.$s->quota.' users. You have indicated that your offer is eligible for free shipping. No further action is required at this time.',
			// 			'prime' => $s->prime,
			// 			'id' => $s->id
			// 		];
			// 	}
			// 	return $response;
			// }
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

				/**
				 * Send only to uses that have not yet received their
				 * new offer notification
				 */
				if(!$user->has_email && !$user->business)
				{
					Mail::send('emails.new-offer', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
					{
						$message->to($user->email)->subject('You have new offers waiting for you!');
					});

					/**
					 * 
					 */
					$user->has_email = true;
					$user->save();
				}
			}

			/**
			 * Notify the business that their offer
			 * is now live
			 */

			$user = $offer->business;
			if(!$offer->business->has_email)
			{
				Mail::send('emails.new-offer', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
				{
					$message->to($user->email)->subject('Your Offer Has Started');
				});
				$offer->business->has_email = true;
				$offer->business->save();
			}
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
								->where('live', false)->get();

				/**
				 * If the matching breaks, this is why
				 * 
				 * This is supposed to ensure that every
				 * new user has the opportunity to be
				 * matched with an offer
				 */
				$newMatches = $this->match($offer);
				if(!empty($newMatches))
					$matches = array_merge(json_decode($matches, true), json_decode($newMatches, true));
				else
					$matches = json_decode($matches, true);
				/**
				 * End the new code breaking
				 */

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
					$match = Matches::find($match['id']);
					/**
					 * Find the user associated with the match
					 */
					$user = $match['user'];

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
						 * 
						 * If the user has already been emailed
						 * do not email him or her again
						 * 
						 * Send only to users that want an email
						 * notification
						 */
						if(!$user->has_email)
						{
							Mail::send('emails.new-offer', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
							{
								$message->to($user->email)->subject('You have new offers waiting for you!');
							});
							$user->has_email = true;
							$user->save();
						}

						/**
						 * Increment $counter
						 */
						$counter++;
					}
				}
			}
		}
	}

	public function postpay($offer)
	{
		/**
		 * Don't charge for trial
		 * promotion
		 */
		if(count($offer->business->offers) == 1)
		{
			return true;
		}

		/**
		 * Set the Rate Per Offer (RPO)
		 */
		$RPO = 5;

		/**
		 * Retrieve all completed orders
		 * associated with $offer
		 */
		$orders = $offer->orders()->where('confirmation_number', true)->get();

		/**
		 * Calculate total cost of
		 * shipping
		 */
		$shipping = 0;
		foreach($orders as $order)
		{
			$shipping += $order->cost;
		}

		/**
		 * Set a description for the charge
		 */
		$description = "Payment for promotion #".$offer->id;

		/**
		 * Calculate total cost of the
		 * promotion using the following
		 * algorithm:
		 * 
		 * (number of orders x $RPO)
		 * + total cost of shipping ($shipping)
		 * x 100
		 * = $sum
		 */
		$sum = ((count($orders) * $RPO) + $shipping) * 100;

		/**
		 * Retrieve the Stripe customer
		 * associated with the business
		 */
		$customer = \Stripe_Customer::retrieve($offer->business->stripe_customer);

		if(count($orders))
		{
			$response = \Stripe_Charge::create([
				'amount' => $sum,
				'currency' => 'usd',
				'customer' => $customer,
				// 'source' => $offer->billing
			]);
		}

		/**
		 * Mark the offer as billed
		 */
		$offer->billed = true;
		$offer->save();

		/**
		 * Store the charge
		 */
		$charge = new Charge();
		$charge->user_id = $offer->business_id;
		$charge->charge_id = $response->id;
		$charge->card_id = $customer->sources->data[0]->id;
		$charge->charge = ($sum/100);
		$charge->save();

		if($response)
			return $response;
		else
			return 'No redeemed offers';
	}

	public function closeOffers()
	{
		$date = new DateTime();
		$date->sub(new DateInterval('P1D'));
		$offers = Offer::where(['end' => $date->format('Y-m-d'), 'billed' => false])->get();
		if(count($offers))
		{
			foreach($offers as $offer)
			{
				$this->postpay($offer);
			}
			return $offers;
		}
		return 'No offers to charge for.';
	}

	/*****************************
	 ** AS OF 03/07/2015 WE ARE **
	 ** NO LONGER CHECKING      **
	 ** WHETHER THE BUSINESS    **
	 ** OWNS ANY NUMBER OF      **
	 ** "OFFER PACKS", AS THIS  **
	 ** OPTION IS BEING REMOVED **
	 ** ENTIRELY                **
	 *****************************/

	// public function offerPurchase($input)
	// {
	// 	$token = $input['stripeToken'];
	// 	$pack = (int)($input['pack']);
	// 	switch($pack)
	// 	{
	// 		case 1:
	// 			$amount = '250.00';
	// 			$count = 50;
	// 			$prime = false;
	// 			break;
	// 		case 2:
	// 			$amount = '450.00';
	// 			$count = 100;
	// 			$prime = false;
	// 			break;
	// 		case 3:
	// 			$amount = '800.00';
	// 			$count = 200;
	// 			$prime = false;
	// 			break;
	// 		case 4:
	// 			$amount = '300.00';
	// 			$count = 50;
	// 			$prime = true;
	// 			break;
	// 		case 5:
	// 			$amount = '530.00';
	// 			$count = 100;
	// 			$prime = true;
	// 			break;
	// 		case 6:
	// 			$amount = '900.00';
	// 			$count = 200;
	// 			$prime = true;
	// 			break;
	// 		default:
	// 			return 'You selected an option that does not exist.';
	// 	}

	// 	$response = $this->gateway->purchase(['amount' => $amount, 'currency' => 'USD', 'token' => $token])->send();

	// 	/**
	// 	 * Creat a new OfferPack
	// 	 */
	// 	$offerPack = new OfferPack();
	// 	$offerPack->prime		= $prime;
	// 	$offerPack->total		= $count;
	// 	$offerPack->used		= 0;
	// 	$offerPack->remaining	= $count;
	// 	$offerPack->cost		= (float)($amount);

	// 	/**
	// 	 * Save the OfferPack
	// 	 */
	// 	$offerPack->save();

	// 	/**
	// 	 * Get the logged in user to assign the
	// 	 * OfferPack to
	// 	 */
	// 	$user = Auth::user();

	// 	/**
	// 	 * Assign the OfferPack to $user
	// 	 */
	// 	$user->offerPack()->save($offerPack);

	// 	return $response;
	// }

	// public function offerPacks($user)
	// {
	// 	/**
	// 	 * Get all offer packs the user has
	// 	 * purchased
	// 	 */
	// 	$packs = $user->offerPack;

	// 	/**
	// 	 * Get number of packs user owns
	// 	 */
	// 	$packTotal = count($packs);

	// 	/**
	// 	 * Discover how many offers total
	// 	 * the user has not used
	// 	 * 
	// 	 * Discover how many unused Prime
	// 	 * offers the user has
	// 	 */
	// 	$offerTotal	= 0;
	// 	$primeTotal = 0;

	// 	/**
	// 	 * Iterate through the offer packs
	// 	 */
	// 	foreach($packs as $pack)
	// 	{
	// 		/**
	// 		 * Add the remaining (unused) offers
	// 		 * from each pack to the $offerTotal
	// 		 */
	// 		$offerTotal += $pack->remaining;

	// 		/**
	// 		 * Determine if the OfferPack is for
	// 		 * Prime or regular
	// 		 * 
	// 		 * If the pack is for Prime, add the
	// 		 * remaining (unused) offers to the
	// 		 * primeTotal
	// 		 */
	// 		if($pack->prime)
	// 			$primeTotal += $pack->remaining;
	// 	}

	// 	/**
	// 	 * Build an array of the OfferPack data
	// 	 */
	// 	$data = [
	// 		'packs'		=> $packs,
	// 		'total'		=> $packTotal,
	// 		'offers'	=> $offerTotal,
	// 		'prime'		=> $primeTotal,
	// 	];

	// 	return $data;
	// }
}