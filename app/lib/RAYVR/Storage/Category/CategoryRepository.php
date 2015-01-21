<?php namespace RAYVR\Storage\Category;
	
interface CategoryRepository {

	public function all();

	public function find($id);

	public function create($input);
}