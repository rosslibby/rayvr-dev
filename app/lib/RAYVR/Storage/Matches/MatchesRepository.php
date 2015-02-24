<?php namespace RAYVR\Storage\Matches;
	
interface MatchesRepository {

	public function all();

	public function find($id);

	public function create($input);
}