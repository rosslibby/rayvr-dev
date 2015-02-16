<?php namespace RAYVR\Storage\Offer;

use RAYVR\Storage\Category\CategoryRepository as Category;

use Offer, Interest, User, Omnipay\Omnipay, Auth, Reimbursement, Mail;

class EloquentOfferRepository implements OfferRepository {

	protected $category;

	public function __construct(Category $category, Reimbursement $reimbursement)
	{
		$this->category = $category;
		$this->reimbursement = $reimbursement;
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

			/**
			 * Check if user is currently
			 * in offer
			 */
			if(!$user->current && $quota < $daily_quota)
			{
				Mail::send('emails.offer-match', ['name' => $user['first_name'], 'from' => 'The RAYVR team', 'send_at' => $offer->start], function($message) use ($user)
				{
					$message->to($user->email)->subject('You have new offers waiting for you!');
				});

				/**
				 * Increment $quota so that we
				 * schedule the appropriate
				 * number of emails for day 1
				 */
				$quota++;
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

	public function claim($user, $offer, $cost)
	{
		/**
		 * Send reimbursement to user's email
		 */
		if($user)
			$email = $user['email'];
		else
			return "User is not logged in; we can't send a refund to a person that doesn't exist. smh.";

		/**
		 * Step 1: Fetch the access token
		 */
		$url = 'https://api.sandbox.paypal.com/v1/oauth2/token';
		$client_id = 'AYlbChCk7mTzAcQD1u_rxLr4KB0PNE9QhmJU6Gmfh_9scFyzoeGiCckcfQsy';
		$secret = 'EGmHiRAE1KdRZqBIkphWz5NfNkPKwgHu6nHz_MQkTuEcaQ-Kmf-AqhmImrUr';

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Accept-Language: en_US']);
		curl_setopt($curl, CURLOPT_USERPWD, $client_id.':'.$secret);
		curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($curl);
		curl_close($curl);

		/**
		 * Set the access token
		 */
		$access_token = json_decode($result, true)['access_token'];
		echo $access_token;

		/**
		 * Send payment request
		 */
		$url = 'https://api.sandbox.paypal.com/v1/payments/payouts/?sync_mode=true';
		$body = '{
			"sender_batch_header": {
				"email_subject": "You have a payment"
			},
			"items": [
				{
					"recipient_type": "EMAIL",
					"amount": {
						"value": '.$cost.',
						"currency": "USD"
					},
					"receiver": "'.$email.'",
					"note": "Reimbursement for shipping",
					"sender_item_id": '.$offer['id'].'
				}
			]
		}';

		$pay = curl_init();
		curl_setopt($pay, CURLOPT_URL, $url);
		curl_setopt($pay, CURLOPT_HTTPHEADER, [
			'Content-Type:application/json',
			'Authorization: Bearer '.$access_token
		]);
		curl_setopt($pay, CURLOPT_POSTFIELDS, $body);
		curl_setopt($pay, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($pay);
		curl_close($pay);

		var_dump($body);
		echo "<hr>";
		var_dump($result);

		/**
		 * Store the reimbursement
		 */
		$reimburse = $offer->reimbursement()->save($user, ['cost' => 2.18, 'response' => $result]);

		return "The claim for $" . $cost . " has been placed.";
	}
}