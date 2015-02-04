<?php namespace RAYVR\Storage\User;

use User;
use Hashids\Hashids as Hashids;
use Illuminate\Support\Facades\Hash;
use Validator;

class EloquentUserRepository implements UserRepository {

	protected $hashids;

	public function __construct(Hashids $hashids)
	{
		$this->hashids = $hashids;
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
		$input['password'] = Hash::make($password);
		$input['business'] = $business;

		$c = User::create($input);

		if($c)
		{
			$c->invite_code = $this->hashids->encode($c->id);;
			return $c;
		}
	}

	public function create($input)
	{
		$rules = ['email' => 'unique:users,email', 'password_confirmation' => 'same:password'];

		$validator = Validator::make($input, $rules);

		/**
		 * Hash the bloody password before it's too late
		 */
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
			$code = ['invite_code' => $input['email']];
			$input = array_merge($input, $code);
			$c = User::create($input);
			$c->invite_code = $this->hashids->encode($c->id);;
			return [true, $c];
		} else {
			return [false, $validator->messages()->first()];
		}
	}
}