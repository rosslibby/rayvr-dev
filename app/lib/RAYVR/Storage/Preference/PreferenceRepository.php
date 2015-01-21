<?php namespace RAYVR\Storage\Preference;
	
interface PreferenceRepository {

	public function all();

	public function find($id);

	public function create($input);
}