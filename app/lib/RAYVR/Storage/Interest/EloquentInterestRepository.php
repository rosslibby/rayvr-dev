<?php namespace RAYVR\Storage\Interest;

use Interest;

class EloquentInterestRepository implements InterestRepository {

	public function all()
	{
		return Interest::all();
	}

	public function find($id)
	{
		return Interest::find($id);
	}

	public function create($input)
	{
		return Interest::create($input);
	}
}