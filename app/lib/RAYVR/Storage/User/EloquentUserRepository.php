<?php namespace RAYVR\Storage\User;

use User, Matches, Mail, Blacklist, Validator, View, Offer, Order, Omnipay\Omnipay, Voucher, Deposit, OfferPack, Stripe, Billing, Charge, Auth, Category, Interest;
use RAYVR\Storage\Offer\OfferRepository as OfferRepo;
use Hashids\Hashids as Hashids;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository {

	protected $hashids;
	protected $offer;

	public function __construct(Hashids $hashids, OfferRepo $offer)
	{
		$this->hashids = $hashids;

		/**
		 * Set up Omnipay
		 */
		$gateway = Omnipay::create('Stripe');
		$gateway->setApiKey('sk_test_3YmCSPqFkZCBhSroMCu4QAC0');
		Stripe::setApiKey($_ENV['stripe_api_key']);
		$this->gateway = $gateway;

		/**
		 * Offers
		 */
		$this->offer = $offer;
	}

	public function all()
	{
		return User::all();
	}

	public function find($id)
	{
		return User::find($id);
	}

	public function userByEmail($string)
	{
		$id = User::where('email', '=', $string)->get()[0]['id'];
		return User::find($id);
	}

	public function createEarly($input)
	{
		/**
		 * Add in a fake password
		 * 
		 * @return rand
		 * Set as user (not business)
		 * by setting "business" to false
		 * 
		 * @return false
		 */
		$password = $this->hashids->encode(rand(0,12)).$this->hashids->encode(rand(0,12)).$this->hashids->encode(rand(0,12));
		$business = false;

		/**
		 * Modify input array with
		 * forged data
		 */
		$input = array_merge($input, ['password' => Hash::make($password), 'business' => $business, 'invite_code' => $input['email']]);

		$c = User::create($input);
		if($c->invite_code = $this->hashids->encode($c->id))
		{
			$c->save();
			return $c;
		} else {
			return false;
		}
	}

	public function create($input)
	{
		$rules = ['email' => 'unique:users,email', 'password_confirmation' => 'same:password'];

		$validator = Validator::make($input, $rules);

		/**
		 * Hash the bloody password before it's too late
		 */
		if(array_key_exists('password', $input))
			$input['password'] = Hash::make($input['password']);
		/**
		 * Phew! *wipes sweat away from brow* We hashed that
		 * just in time!
		 */

		/**
		 * Whoaa there, where do you think you're going?!
		 * Better determine whether this is a business or
		 * a user, don't you think?
		 */
		if(array_key_exists('business', $input))
			if($input['business'] == 'true')
				$input['business'] = 1;
			else
				$input['business'] = 0;

		/**
		 * Don't just lollygag around! CREATE THE USER!!!
		 * 
		 * -- only if the user doesn't already exist
		 */

		if($validator->passes()){
			/**
			 * Set email as temporary referral code
			 * to get past the "unique" requirement
			 */
			if(array_key_exists('email', $input))
			{
				$code = ['invite_code' => $input['email']];
				$input = array_merge($input, $code);
			}

			/**
			 * If the user has a @rayvr.com
			 * email, make them an admin
			 */
			if(substr($input['email'], (strlen($input['email']) - 10)) == '@rayvr.com')
			{
				$input = array_merge($input, ['active' => 3]);
			}
			else
			{
				$input = array_merge($input, ['active' => 1]);
			}

			$c = User::create($input);
			$c->invite_code = $this->hashids->encode($c->id, mt_rand(100, 100000), mt_rand(100, 100000), mt_rand(100, 100000));

			/**
			 * Assign the user a new
			 * confirmation string
			 */
			$confirmation = $this->hashids->encode(mt_rand(0,100000), mt_rand(0,100000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000), mt_rand(0, 10000));
			$c->confirm = $confirmation;
			$c->save();

			/**
			 * If the user is not a business or
			 * an administrator, set the user
			 * to interested in everything
			 */
			$categories = Category::all();
			foreach($categories as $category)
			{
				$interest = new Interest();
				$interest->user_id = $c->id;
				$interest->cat_id = $category->id;
				$interest->save();
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

			// /**
			//  * If the user is a business, give
			//  * the user 15 offers
			//  */
			// if($c->business)
			// {
			// 	$offerPack = new OfferPack();
			// 	$offerPack->user_id = $c->id;
			// 	$offerPack->total = 15;
			// 	$offerPack->remaining = 15;
			// 	$offerPack->cost = 0.0;
			// 	$offerPack->save();
			// }

			return [true, $c];
		} else {
			return [false, $validator->messages()->first()];
		}
	}

	public function delete($id)
	{
		/**
		 * Get the user from the url parameter "id"
		 */
		$user = User::find($id);

		/**
		 * Permanently delete the user
		 */
		if($user->delete())
			return "The user has been deleted.";
		return "There was an issue; the user still exists.";
	}

	public function suspend($id)
	{
		/**
		 * Get the user from the url parameter "id"
		 */
		$user = User::find($id);

		/**
		 * Set the user's "active" status to false
		 */
		$user->active = false;

		if($user->save())
			return "The user has been suspended.";
		return "There was an issue; the user is still active.";
	}

	public function deactivate($user)
	{
		$user->active = false;
		if($user->save())
			return ['deactivated' => true, 'message' => "Your account has been deactivated."];
		return ['deactivated' => false, 'message' => "There was a problem deactivating your account; please contact <a href=\"/contact\">support</a>."];
	}

	public function type($input)
	{
		$user = User::find($input['id']);
		if($input['type'] == 'User')
		{
			$user->business = false;
			$user->save();
			return "User account is type <em>user</em>";
		}
		else
		{
			$user->business = true;
			$user->save();
			return "User account is type <em>business</em>";
		}
	}

	public function matches($matches)
	{
		/**
		 * Build an array of
		 * matches the user is
		 * eligible for and has
		 * not declined
		 */
		$eligible = [];

		/**
		 * Iterate through matches
		 * to find those that have
		 * not been declined
		 */
		foreach($matches as $match)
		{
			/**
			 * Check if offer has been
			 * declined, accepted, or
			 * neither
			 * 
			 * If neither, add
			 * to array
			 */
			if(!$match->accept && !$match->decline)
				array_push($eligible, $match);
		}

		if(!empty($eligible))
			return $eligible[0];
		else
			return "You have no offers at this time.";
	}

	public function accept($user, $match, $accept)
	{
		/**
		 * Retrieve the match
		 */
		$match = Matches::find($match);

		/**
		 * If the offer is declined
		 * set "decline" to true
		 * 
		 * "accept" is already false
		 * by default and does not
		 * need to be changed
		 * 
		 * If the offer is accepted
		 * set "accept" to true
		 * 
		 * "decline" is already false
		 * by default and does not
		 * need to be changed
		 */
		if($accept == 3)
		{
			$match->decline = true;
			$match->save();
		}
		else
		{
			$match->accept = $accept;
			$match->save();

			/**
			 * Set the user's current
			 * offer to the match's
			 * associated offer
			 */
			$user->current = $match->offer_id;
			$user->save();

			/**
			 * Check if the user is in
			 * a blacklist with the
			 * business.
			 * If true, increment "times"
			 * If false, create the
			 * blacklist
			 */
			if(!empty(json_decode($user->blacklist()->where('business_id', $match->business_id)->get(), true)))
			{
				$blacklist = $user->blacklist()->where('business_id', $match->business_id)->get()[0];
				$blacklist->times = (int)($blacklist->times) + 1;
				$blacklist->save();
			}
			else
			{
				$blacklist = new Blacklist();
				$blacklist->user_id = $user->id;
				$blacklist->business_id = $match->business_id;
				$blacklist->save();
			}

			/**
			 * Fetch a voucher code
			 * for the order
			 */
			$voucher = Voucher::where('offer_id', $match->offer_id)
											->where('used', false)
											->first();

			/**
			 * Create the order
			 */
			$order				= new Order();
			$order->offer_id	= $match->offer_id;
			$order->user_id		= $user->id;
			$order->code		= $voucher->code;
			$order->save();

			/**
			 * Set the voucher code usage
			 * status to true
			 */
			$voucher->used = true;
			$voucher->save();

			/*****************************
			 ** AS OF 03/07/2015 WE ARE **
			 ** NO LONGER CHECKING      **
			 ** WHETHER THE BUSINESS    **
			 ** OWNS ANY NUMBER OF      **
			 ** "OFFER PACKS", AS THIS  **
			 ** OPTION IS BEING REMOVED **
			 ** ENTIRELY                **
			 *****************************/

			/**
			 * Decrement the number of
			 * offers the business has
			 * remaining
			 * 
			 * First, determine whether
			 * this is a prime offer
			 * or a regular offer
			 */
			// $prime = false;
			// if($match->offer->prime)
			// 	$prime = true;
			// $pack = $match->offer->business->offerPack()
			// 						->where('prime', $prime)
			// 						->where('remaining', '!=', 0)
			// 						->get()[0];
			// $pack->used = ((int)($pack->used) + 1);
			// $pack->remaining = ((int)($pack->remaining) - 1);
			// $pack->save();

			/**
			 * Schedule an email to
			 * the user as a reminder
			 * to order the offer
			 */

			Mail::send('emails.order-reminder', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team'], function($message) use ($user)
			{
				$message->to($user->email)->subject('Don\'t Forget To Order Your Offer');
				$headers = $message->getHeaders();
				$headers->addTextHeader('X-MC-SendAt', date("Y-m-d H:i:s", time()+86400));
			});
		}

		return \Redirect::to('offers/current');
	}

	public function currentOffer($user)
	{
		/**
		 * Check if the user is currently in an offer
		 * 
		 * If true, show the offers.current template,
		 * along with the next step in the process
		 * 
		 * Otherwise, show the offers.select template
		 */

		/**
		 * Get the current offer (if any)
		 */
		$current = NULL;
		if($user->current)
		{
			$current = $this->current($user)[0];

			$step_1 = "<span class=\"normal\">Copy this promo code to use at checkout </span><span class=\"label\">" . $current->code . "</span>";
			$step_2 = "Step 2. <span class=\"normal\">Did you pay anything for shipping? If <strong>no</strong>, just click \"I didn't pay for shipping.\"; otherwise, enter your shipping cost below.";
			$step_3 = "Step 3. <span class=\"normal\">Try out your offer as soon as you receive it, and leave a review <a href=\"".$current->review_link."\" target=\"_blank\">here</a>. Then, copy + paste the text from your review to the box below to complete your offer!</span>";

			if(!$current->confirmation_number)
				$step = [
					'step'		=> 1,
					'message'	=> $step_1,
					'link'		=> $current->offer->link
				];
			elseif(!$current->review)
				$step = [
					'step'		=> 3,
					'link'		=> $current->review_link,
					'offer'		=> $current->offer,
					'order'		=> $current,
					'message'	=> $step_3
				];

			return View::make('offers.current')
					->with('current', $current)
					->with('step', $step)
					->with('success', $success = null);
		}

		return View::make('offers.select')->with('matches', $this->matches($user->matches));
	}

	public function current($user)
	{
		return $user->order()
				->where('offer_id', $user->current)
				->get();
	}

	public function stripeData($user)
	{
		if($user->stripe_customer)
		{
			$customer = \Stripe_Customer::retrieve($user->stripe_customer);
			$charges = Charge::where('user_id', $user->id)->get();

			$data = [
				'customer' => $customer,
				'charges' => $charges
			];

			return $data;
		}
	}

	public function createCustomer($input, $user)
	{
		/**
		 * Retrieve the Stripe token
		 */
		$token = $input['stripeToken'];

		/**
		 * Retrieve the user ID
		 */
		$user_id = $user->id;

		/**
		 * Retrieve the user email
		 */
		$email = $user->email;

		/**
		 * Create a new Stripe customer
		 * if one does not already exist
		 * for this user
		 */

		if(!$user->stripe_customer)
		{
			$customer = \Stripe_Customer::create([
				'description' => 'Lifetime free membership for user #'.$user_id,
				'source' => $token,
				'email' => $email,
				'metadata' => [
					'id' => $user_id
				]
			]);

			/**
			 * Save the customer ID with its associated user
			 */
			$user->stripe_customer = $customer->id;
			$user->save();
			$card = $customer->sources->data[0];
		}
		else
		{
			$customer = \Stripe_Customer::retrieve($user->stripe_customer);
			/**
			 * Create a card with the customer
			 */
			$card = $customer->sources->create([
				'source' => $token
			]);

			/**
			 * Insert this card into the billing table
			 */
			$billing = new Billing();
			$billing->user_id = $user->id;
			$billing->stripe_id = $card->id;
			$billing->save();
		}

		/**
		 * Verify that the card is valid
		 * and functional
		 */
		$verify = $this->verify($customer, $card, $user);
		return 'hahaha';

		return $verify;
	}

	public function postpay($offer)
	{
		/**
		 * Set the Rate Per Offer (RPO)
		 */
		$RPO = 5;

		/**
		 * Retrieve all completed orders
		 * associated with $offer
		 */
		$orders = $offer->orders()->where('completed', true)->get();

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

		$response = \Stripe_Charge::create([
			'amount' => $sum,
			'currency' => 'usd',
			'customer' => $customer
		]);

		/**
		 * Store the charge
		 */
		$charge = new Charge();
		$charge->user_id = $offer->business_id;
		$charge->charge_id = $response->id;
		$charge->card_id = $customer->sources->data->id;
		$charge->charge = ($sum/100);
		$charge->save();

		return $response;
	}

	public function verify($customer, $card, $user)
	{
		$response = \Stripe_Charge::create([
			'amount' => 100,
			'currency' => 'usd',
			'customer' => $customer,
			'source' => $card
		]);

		/**
		 * Store the charge
		 */
		$charge = new Charge();
		$charge->user_id = $user->id;
		$charge->charge_id = $response->id;
		$charge->card_id = $card->id;
		$charge->charge = 1.00;
		$charge->save();

		/**
		 * If the charge was successfull:
		 * 1. Set the billing status to
		 * "verified"
		 * 2. Refund the charge
		 */
		if($response->paid && !$response->refunded)
		{
			$billing = Billing::where('stripe_id', $card->id)->first();
			$billing->verified = true;
			$billing->save();

			$ch = \Stripe_Charge::retrieve($response->id);
			$re = $ch->refunds->create();
		}
	}

	public function subscribe($input, $user)
	{
		$token = $input['stripeToken'];
		$plan = (int)($input['plan']);
		switch($plan)
		{
			case 1:
				$amount = '80.00';
				$plan = 'monthlyMembership';
				break;
			case 2:
				$amount = '420.00';
				$plan = '6monthlyMembership';
				break;
			case 3:
				$amount = '740.00';
				$plan = 'yearlyMembership';
				break;
			default:
				return 'You selected an option that does not exist.';
		}

		/**
		 * Create the subscription
		 */
		return $user->subscription($plan)->create($token);
	}

	public function membership($user)
	{
		/**
		 * Create an array of the user's
		 * current membership data
		 * 
		 * Determine the name of the
		 * user's subscription
		 */

		$subscription = null;
		if($user->stripe_plan == 'monthlyMembership')
		{
			$subscription = 'Monthly member';
		}
		elseif($user->stripe_plan == '6monthlyMembership')
		{
			$subscription = '6-month member';
		}
		elseif($user->stripe_plan == 'yearlyMembership')
		{
			$subscription = 'Annual member';
		}
		$membership = [
			'member'		=> $user->stripe_active,
			'id'			=> $user->stripe_id,
			'subscription'	=> $user->stripe_subscription,
			'plan'			=> $subscription,
			'card'			=> $user->last_four,
			'trial'			=> $user->trial_ends_at,
			'expiration'	=> $user->subscription_ends_at,
		];

		return $membership;
	}

	public function cancelMembership($user)
	{
		$user->subscription()->cancel();
	}

	public function deposit($user, $data)
	{
		$sum = $data['amt'];
		$currency = $data['cc'];
		$signature = $data['sig'];
		$status = $data['st'];
		$tx = $data['tx'];

		$deposit = new Deposit();
		$deposit->user_id = $user->id;
		$deposit->sum = $sum;
		$deposit->remaining = $sum;
		$deposit->currency = $currency;
		$deposit->signature = $signature;
		$deposit->status = $status;
		$deposit->tx = $tx;
		$deposit->save();
	}

	public function reset($user)
	{
		/**
		 * Get $user from the email
		 * that was passed through
		 */
		$user = $this->userByEmail($user);

		/**
		 * Generate a confirmation code for
		 * the user
		 */
		$confirm = md5(uniqid(mt_rand(), true));

		/**
		 * Set the user's 'confirm' record
		 * to the new code
		 */
		$user->confirm = $confirm;

		/**
		 * Save the user
		 */
		$user->save();

		/**
		 * Send the user an email to
		 * reset their password
		 * 
		 * First, build a link for the
		 * user to reset their
		 * password
		 */
		$invite = $user->invite_code;
		$link = url().$user->email.'/'.$invite.'/'.$confirm;

		Mail::send('emails.forgot-password', ['name' => $user->first_name, 'from' => 'RAYVR Support', 'link' => $link], function($message) use ($user)
		{
			$message->to($user->email)->subject('Password Reset Request');
		});
	}

	public function invite($data, $user)
	{
		$name = $data['name'];
		$email = $data['email'];
		Mail::send('emails.invite-user', ['name' => $name, 'from' => $user->first_name.' '.$user->last_name], function($message) use ($name, $email)
		{
			$message->to($email)->subject('Hey '.$name.'! You\'re invited to join RAYVR');
		});
	}
}