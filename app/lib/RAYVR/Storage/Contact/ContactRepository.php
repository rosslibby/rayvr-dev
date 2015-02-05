<?php namespace RAYVR\Storage\Contact;
	
interface ContactRepository {

	public function all();

	public function find($id);

	public function create($input);
}