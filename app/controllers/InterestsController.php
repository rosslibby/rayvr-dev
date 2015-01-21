<?php

use RAYVR\Storage\User\UserRepository as User;
use RAYVR\Storage\Category\CategoryRepository as Category;
use RAYVR\Storage\Interest\InterestRepository as Interest;

class InterestsController extends BaseController {

	/**
	 * Add User Repository
	 * Add Category Repository
	 * Add Interest Repository
	 */
	protected $user;
	protected $category;
	protected $interest;

	/**
	 * Inject the User Repository
	 * Inject the Category Repository
	 * Inject the Interest Repository
	 */
	public function __construct(User $user, Category $category, Interest $interest)
	{
		$this->user = $user;
		$this->category = $category;
		$this->interest = $interest;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
