<?php namespace RAYVR\Storage\Preference;
	
interface PreferenceRepository {

	public function all();

	public function find($id);

	public function create($input);

	public function interests($preferences, $interests);

	public function preferences($preferences, $user);
}