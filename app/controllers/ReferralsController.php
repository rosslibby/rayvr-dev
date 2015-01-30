<?php

class ReferralsController extends \BaseController {

	/**
	 * Display a listing of referrals
	 *
	 * @return Response
	 */
	public function index()
	{
		$referrals = Referral::all();

		return View::make('referrals.index', compact('referrals'));
	}

	/**
	 * Show the form for creating a new referral
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('referrals.create');
	}

	/**
	 * Store a newly created referral in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Referral::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Referral::create($data);

		return Redirect::route('referrals.index');
	}

	/**
	 * Display the specified referral.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$referral = Referral::findOrFail($id);

		return View::make('referrals.show', compact('referral'));
	}

	/**
	 * Show the form for editing the specified referral.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$referral = Referral::find($id);

		return View::make('referrals.edit', compact('referral'));
	}

	/**
	 * Update the specified referral in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$referral = Referral::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Referral::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$referral->update($data);

		return Redirect::route('referrals.index');
	}

	/**
	 * Remove the specified referral from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Referral::destroy($id);

		return Redirect::route('referrals.index');
	}

}
