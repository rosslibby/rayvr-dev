<?php namespace RAYVR\Storage\Contact;

use Contact;

class EloquentContactRepository implements ContactRepository {

	public function all()
	{
		return Contact::all();
	}

	public function find($id)
	{
		return Contact::find($id);
	}

	public function create($input)
	{
		return Contact::create($input);
	}
}