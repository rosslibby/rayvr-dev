<?php namespace RAYVR\Storage\Interest;
	
interface InterestRepository {

	public function all();

	public function find($id);

	public function create($input);
}