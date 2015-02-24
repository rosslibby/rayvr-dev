<?php namespace RAYVR\Storage\Matches;

use Matches;

class EloquentMatchesRepository implements MatchesRepository {

	public function all()
	{
		return Matches::all();
	}

	public function find($id)
	{
		return Matches::find($id);
	}

	public function create($input)
	{
		return Matches::create($input);
	}
}