<?php namespace RAYVR\Storage\User;

use User;
use Hashids\Hashids as Hashids;
use Illuminate\Support\Facades\Hash;

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
		$c = User::create($input);

		if($c)
		{
			$c->invite_code = $this->hashids->encode($c->id);;
			return $c;
		}
	}
}