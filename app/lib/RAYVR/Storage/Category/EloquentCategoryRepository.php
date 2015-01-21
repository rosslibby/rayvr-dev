<?php namespace RAYVR\Storage\Category;

use Category;

class EloquentCategoryRepository implements CategoryRepository {

	public function all()
	{
		return Category::all();
	}

	public function find($id)
	{
		return Category::find($id);
	}

	public function create($input)
	{
		return Category::create($input);
	}
}