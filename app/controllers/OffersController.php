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
			 * Start ye old page scraper
			 */
			$cc = new Copycat;
			$cc->setCURL(array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_HTTPHEADER, "Content-Type: text/html; charset=iso-8859-1",
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
				CURLOPT_PROGRESSFUNCTION => 'callback'
			));

			$cc->match(array(
				'title' => '/id="productTitle" class="a-size-large">(.*?)</ms',
				'photo' => '/id="landingImage" data-a-dynamic-image="{&quot;(.*?)&/',
				'description' => '/var iframeContent = "(.*?)"/'
			))->URLs($url)
			->callback(array(
				'_all_' => array('trim')
			));
//				return $cc->get();

			/**
			 * For testing purposes, return a false array
			 */
			$product = array(
				'photo' => $cc->get()[0]['photo'],
				'title' => $cc->get()[0]['title'],
				'description' => urldecode($cc->get()[0]['description']),
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
