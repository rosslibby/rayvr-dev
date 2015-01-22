<?php

class OffersController extends \BaseController {

	/**
	 * Display a listing of offers
	 *
	 * @return Response
	 */
	public function index()
	{
		$offers = Offer::all();

		return View::make('offers.index', compact('offers'));
	}

	/**
	 * Show the form for creating a new offer
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('offers.create');
	}

	/**
	 * Store a newly created offer in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Offer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Offer::create($data);

		return Redirect::route('offers.index');
	}

	/**
	 * Display the specified offer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$offer = Offer::findOrFail($id);

		return View::make('offers.show', compact('offer'));
	}

	/**
	 * Show the form for editing the specified offer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$offer = Offer::find($id);

		return View::make('offers.edit', compact('offer'));
	}

	/**
	 * Update the specified offer in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$offer = Offer::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Offer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$offer->update($data);

		return Redirect::route('offers.index');
	}

	/**
	 * Remove the specified offer from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Offer::destroy($id);

		return Redirect::route('offers.index');
	}

}
