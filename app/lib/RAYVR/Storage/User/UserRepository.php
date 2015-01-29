<?php namespace RAYVR\Storage\User;
	
interface UserRepository {

	public function all();

	public function find($id);

	public function userByEmail($string);

	public function create($input);

	public function createEarly($input);
}