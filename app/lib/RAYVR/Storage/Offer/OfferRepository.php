<?php namespace RAYVR\Storage\Offer;
	
interface OfferRepository {

	public function all();

	public function find($id);

	public function track($id);

	public function categories($data, $categories, $business);

	public function offers($userid);
}