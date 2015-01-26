<?php namespace RAYVR\Storage\User;

use User;
use Hashids\Hashids as Hashids;

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