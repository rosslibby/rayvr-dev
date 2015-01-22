<?php

class OffersController extends BaseController {

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
	public function add()
	{
		return View::make('offers.add', array('progress' => 63));
	}

	/**
	 * Show the offer tracking view
	 */
	public function track()
	{
		$offers = Offer::all();

		return View::make('offers.track');
	}

	/**
	 * Fetch offer data
	 * 
	 * @return JSON array
	 */
	public function fetch()
	{
		if(Request::ajax())
		{
			$url = Input::get('url');
			/**
			 * For testing purposes, return a false array
			 */
			$product = array(
				'photo' => 'http://ecx.images-amazon.com/images/I/71YPFO-Q%2BLL._SL1500_.jpg',
				'title' => 'Symphonized NRG Premium Genuine Wood In-ear Noise-isolating Headphones with Mic (White)',
				'description' => 'With its unique acoustical properties, wood provides the best sound reproduction there is, which is why most high-end speakers and many musical instruments are made of wood, not to mention the interiors of concert halls. And that\'s where you\'ll feel you are when you listen to your favorite audio devices with Symphonized natural wood headphones, with neodymium magnets providing enough power to bring out top-quality acoustics, surrounding you with energizing, high- fidelity sound as if you\'re right there at a live show. With their superior strength and durability, excellent noise isolation, distortion-free volume levels and deep base, Symphonized headphones are perfect for iPhones, iPods and iPads, mp3 players, CD players and more. Choose Symphonized natural wood headphones for your listening pleasure, and we\'re sure you\'ll never go back to plastic.',
				'url' => $url
			);

			return $product;
		}
		return "WRONG LEVERRRR!!";
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
