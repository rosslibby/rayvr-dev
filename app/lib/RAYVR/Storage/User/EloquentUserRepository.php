<?php namespace RAYVR\Storage\User;

use User;

class EloquentUserRepository implements UserRepository {

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

	public function create($input, $code)
	{
		$invite = ['invite_code' => $code];
		$input = array_merge($input, $invite);

		return User::create($input);
	}
}