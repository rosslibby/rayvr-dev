<?php namespace RAYVR\Storage\Order;

use User, Mail, Order, Offer, Reimbursement, Dispute, Feedback;

class EloquentOrderRepository implements OrderRepository {

	public function all()
	{
		return Order::all();
	}

	public function find($id)
	{
		return Order::find($id);
	}

	public function create($input)
	{
		return Order::create($input);
	}

	public function orders($id)
	{
		$offer = Offer::find($id);
		return $offer->orders;
	}

	public function ordered($orders)
	{
		/**
		 * Build an array to
		 * store the ordered
		 * items in
		 */
		$ordered = [];

		/**
		 * Iterate through $orders
		 * array. If a confirmed
		 * order is found, add it
		 * to the $ordered array
		 */
		foreach($orders as $order)
		{
			if($order->confirmation_number != '' && $order->confirmation_number != NULL)
				array_push($ordered, $order);
		}

		return $ordered;
	}

	public function reviews($orders)
	{
		/**
		 * Build an array to
		 * store the reviewed
		 * items in
		 */
		$reviewed = [];

		/**
		 * Iterate through $orders
		 * array. If a review is
		 * found, add it to the
		 * $reviewed array
		 */
		foreach($orders as $order)
		{
			if($order->review != '' && $order->review != NULL)
				array_push($reviewed, $order);
		}

		return $reviewed;
	}

	public function shipping($orders)
	{
		/**
		 * Build an array to
		 * store items with
		 * associated shipping
		 * claims
		 */
		$shipping = [];

		/**
		 * Iterate through $orders
		 * array. If a shipping
		 * claim is found, add it
		 * to the $shipping array
		 */
		foreach($orders as $order)
		{
			if($order->reimbursement)
				array_push($shipping, $order->reimbursement);
		}

		return $shipping;
	}

	public function data($id)
	{
		$orders				= $this->orders($id);
		$ordered			= $this->ordered($orders);
		$reviewed			= $this->reviews($orders);
		$shipping			= $this->shipping($orders);

		/**
		 * Stores the data
		 */
		$information = [
			'orders'			=> $orders,
			'ordered'			=> $ordered,
			'reviewed'			=> $reviewed,
			'shipping'			=> $shipping,
		];

		/**
		 * Stores the count of
		 * each result
		 */
		$count = [];
		foreach($information as $key => $counted)
		{
			$counted = count($counted);
			array_push($count, [$key => $counted]);
		}

		/**
		 * Builds associative array
		 * of $information and $count
		 */
		$data = [
			'data' => $information,
			'count' => $count
		];

		return $data;
	}

	public function paidShipping($user, $cost)
	{
		$order = Order::where(['user_id' => $user->id, 'offer_id' => $user->current])->get()[0];
		$order->paid_shipping = true;
		$order->cost = $cost;
		$order->save();
		return \Redirect::to('/offers/current');
	}

	public function moderateClaim()
	{
		$conditions = [
			'paid_shipping' => true,
			'reimbursed' => false
		];
		$shipping = Order::where($conditions)->where('cost', '>', 0)->get();
		return $shipping;
	}

	public function approveClaim($input)
	{
		$this->claim(json_decode($input['user']), json_decode($input['order']), $input['cost']);
		return \Redirect::to('shipping/moderate');
	}

	public function claim($user, $order, $cost)
	{
		/**
		 * Send reimbursement to user's email
		 */
		if($user)
			$email = $user->email;
		else
			return "User is not logged in; we can't send a refund to a person that doesn't exist. smh.";

		/**
		 * Step 1: Fetch the access token
		 */
		$url = $_ENV['paypal_api_url'];
		$client_id = $_ENV['paypal_client_id'];
		$secret = $_ENV['paypal_secret'];

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

		/**
		 * Send payment request
		 */
		$url = $_ENV['paypal_payment_url'];
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
					"sender_item_id": '.$order->id.'
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

		/**
		 * Store the reimbursement
		 * claim
		 */

		$values = [
			'order_id'	=> $order->id,
			'cost'		=> $cost,
			'response'	=> $result,
		];

		$claim = new Reimbursement();
		$claim->fill($values);
		$claim->save();

		/**
		 * Set the order "reimbursed"
		 * status to true
		 */
		$order = Order::find($order->id);
		$order->reimbursed = true;
		$order->save();

		return "The claim for $" . $cost . " has been placed.";
	}

	public function dispute($claim)
	{
		$claim = Reimbursement::find($claim);
		$claim->dispute = true;
		$claim->save();

		/**
		 * Create new dispute
		 * relationship
		 */
		$dispute = new Dispute();
		$dispute->save();
		$claim->disputed()->save($dispute);

		/**
		 * Cancel the current
		 * PayPal payout
		 * 
		 * Create the URL using
		 * the payout-item-id
		 * from the response
		 * 
		 * Step 1: Fetch the access token
		 */
		$url = $_ENV['paypal_api_url'];
		$client_id = $_ENV['paypal_client_id'];
		$secret = $_ENV['paypal_secret'];

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

		$payout_item_id = json_decode($claim->response, true)['items'][0]['payout_item_id'];
		$url = $_ENV['paypal_cancel_url'].$payout_item_id.'/cancel';
		$cancel = curl_init();
		curl_setopt($cancel, CURLOPT_URL, $url);
		curl_setopt($cancel, CURLOPT_HTTPHEADER, [
			'Content-Type:application/json',
			'Content-Encoding:gzip',
			'Authorization: Bearer '.$access_token
		]);
		curl_setopt($cancel, CURLOPT_POSTFIELDS, '{}');
		curl_setopt($cancel, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($cancel);
		$claim->response = $response;
		if($claim->save())
		{
			/**
			 * Find the business that owns
			 * the offer associated with
			 * the claim
			 */
			$business = User::find($claim->order->offer->business->id);

			/**
			 * Email the business to notify
			 * the end of the offer
			 */
			Mail::send('emails.business-shipping-dispute-filed', ['name' => $business->first_name.' '.$business->last_name, 'from' => 'The RAYVR team'], function($message) use ($business)
			{
				$message->to($business->email)->subject('Your Shipping Dispute Has Been Filed');
			});
			return "The claim for a refund of $". $claim->cost ." has been disputed and the current payout has been cancelled.";
		}
	}

	public function feedback($input, $user)
	{
		$data = $input;
		$data = array_merge($data, ['user_id' => $user->id, 'offer_id' => $user->current]);
		$feedback = new Feedback();
		$feedback->fill($data);
		if($feedback->save())
		{
			/**
			 * Set the order to complete
			 */
			$orders = Order::where(['user_id' => $user->id, 'offer_id' => $user->current])->get();
			foreach($orders as $order)
			{
				$order->completed = true;
				$order->review = true;
				$order->save();
			}

			/**
			 * Reset the user's current offer
			 */
			$user->current = 0;
			$user->save();
			
			return true;
		}
		else
		{
			return false;
		}
	}

	public function confirm($user, $confirmation)
	{
		$order = Order::where(['user_id' => $user->id, 'offer_id' => $user->current])->get()[0];
		// Temporarily do not require order confirmation number
		// instead, enter a false number
		$order->confirmation_number = $confirmation;
		//$order->confirmation_number = 'implicitly_confirmed';
		$order->save();
		$successMsg = "Your order has been confirmed with code <strong>" . $confirmation . "</strong>";

		/**
		 * Set the user's email status to false
		 */
		$user->has_email = false;
		$user->save();

		/**
		 * Schedule review-reminder email
		 * for user
		 */
		Mail::send('emails.review-reminder', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
		{
			$message->to($user->email)->subject('Don\'t Forget: Leave Feedback For Your Offer');

			$headers = $message->getHeaders();
			$headers->addTextHeader('X-MC-SendAt', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + 2 days')));
		});

		return \Redirect::to('offers/current')->with('success', $successMsg);
	}

	public function review($user, $review)
	{
		$order = Order::where(['user_id' => $user->id, 'offer_id' => $user->current])->get()[0];
		$order->review = true;
		$order->save();

		/**
		 * Clear the user's email flag for their next offer
		 */
		$user->has_email = false;
		$user->save();

		$response = "Your offer has been marked as <strong>complete</strong>.";

		/**
		 * Now that the offer is
		 * complete, set the user's
		 * "current" to NULL to make
		 * room for a new offer
		 */
		$user->current = NULL;
		$user->save();

		/**
		 * Retreive number of reviews
		 * confirmed. If the number
		 * meets the offer quota, 
		 * the offer is complete.
		 * Send an email notifying
		 * the business of the offer
		 * end.
		 * 
		 * Begin by finding the offer
		 */
		$offer = $order->offer;

		/**
		 * Check if the number of reviews
		 * is the same as the quota
		 */
		if($this->data($order->offer->id)['count'][2]['reviewed'] >= $offer->quota)
		{
			/**
			 * Find the business that owns
			 * the offer
			 */
			$business = User::find($offer->business->id);
			
			/**
			 * Email the business to notify
			 * the end of the offer
			 */
			Mail::send('emails.offer-completed', ['name' => $business->first_name.' '.$business->last_name, 'from' => 'The RAYVR team'], function($message) use ($business)
			{
				$message->to($business->email)->subject('Your Offer Has Been Completed');
			});
		}

		return \Redirect::to('offers/current')->with('success', $response);
	}

	public function shippingProof($order, $document)
	{
		/**
		 * Get the appropriate
		 * order, reimbursement, and
		 * dispute objects
		 */
		$order			= Order::find($order);
		$reimbursement	= $order->reimbursement;
		$dispute		= $reimbursement->disputed;

		/**
		 * Upload the file
		 */
		$file = $document;
		$extension = ".".$file->getClientOriginalExtension();
		$destinationPath = public_path().'/uploads/';
		$filename = "Shipping-Document-".str_random(14)."-".microtime(true).$extension;
		$document->move($destinationPath, $filename);

		/**
		 * Save the file path
		 * in the dispute 'evidence'
		 * column
		 */
		$dispute->evidence = $destinationPath.$filename;
		$dispute->save();
		return $reimbursement->disputed;
	}
}