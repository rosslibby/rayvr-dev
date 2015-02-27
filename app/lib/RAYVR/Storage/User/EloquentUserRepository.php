<?php namespace RAYVR\Storage\User;

use User, Matches, Mail, Blacklist, Validator, View, Offer, Order, Omnipay\Omnipay, Voucher, Deposit;
use Hashids\Hashids as Hashids;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository {

	protected $hashids;

	public function __construct(Hashids $hashids)
	{
		$this->hashids = $hashids;

		/**
		 * Set up Omnipay
		 */
		$gateway = Omnipay::create('Stripe');
		$gateway->setApiKey('sk_test_3YmCSPqFkZCBhSroMCu4QAC0');
		$this->gateway = $gateway;
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

			$c = User::create($input);
			$c->invite_code = $this->hashids->encode($c->id);;

			return [true, $c];
		} else {
			return [false, $validator->messages()->first()];
		}
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
				$blacklist->times = 2;
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

			/**
			 * Decrement the number of
			 * offers the business has
			 * remaining
			 * 
			 * First, determine whether
			 * this is a prime offer
			 * or a regular offer
			 */
			$prime = false;
			if($match->offer->prime)
				$prime = true;
			$pack = $match->offer->business->offerPack()
									->where('prime', $prime)
									->where('remaining', '!=', 0)
									->get()[0];
			$pack->used = ((int)($pack->used) + 1);
			$pack->remaining = ((int)($pack->remaining) - 1);
			$pack->save();

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

			/**
			 * $code will be fetched from $order
			 * but for now I'll set a filler $code
			 */
			$code = 'FILLER09';

			$step_1 = "Step 1. <span class=\"normal\">Order your offer using the code </span><span class=\"label\">" . $current->code . "</span>";
			$step_2 = "Step 2. <span class=\"normal\">Did you pay anything for shipping? If <strong>no</strong>, just click \"I didn't pay for shipping.\"; otherwise, enter your shipping cost below.";
			$step_3 = "Step 3. <span class=\"normal\">Try out your offer as soon as you receive it, and leave a review <a href=\"#\" target=\"_blank\">here</a>.</span>";

			if(!$current->confirmation_number)
				$step = [
					'step'		=> 1,
					'message'	=> $step_1
				];
			elseif(!$current->paid_shipping)
				$step = [
					'step'		=> 2,
					'message'	=> $step_2
				];
			elseif(!$current->review)
				$step = [
					'step'		=> 3,
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
}