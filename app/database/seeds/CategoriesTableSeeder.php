<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$titles = [
			'Arts, Crafts & Sewing',
			'Auto Accessories',
			'Baby',
			'Beauty',
			'Cell Phone Accessories',
			'Clothing & Jewelry',
			'Computer / Electronics',
			'Health & Personal Care',
			'Home & Kitchen',
			'Kids',
			'Office Products',
			'Patio, Lawn & Garden',
			'Pet Supplies',
			'Sports & Outdoors',
			'Tools & Home Improvement',
			'Toys & Games'
		];

		foreach($titles as $title)
		{
			Category::create([
				'title' => $title,
				'count' => 0
			]);
		}
	}

}