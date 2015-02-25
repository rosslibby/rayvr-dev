<?php

use RAYVR\Storage\Category\CategoryRepository as Category;
use RAYVR\Storage\Offer\OfferRepository as Offer;
use RAYVR\Storage\Order\OrderRepository as Order;
use RAYVR\Storage\User\UserRepository as User;

/**
 * Bring in the PayPal!!!
 */
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Types\AP\PayRequest;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\Common\RequestEnvelope;

class OffersController extends BaseController {

	/**
	 * Use Category repository
	 * Use Offer repository
	 */
	protected $category;
	protected $offer;
	protected $order;
	protected $user;

	/**
	 * PayPal API context
	 */
	private $_api_context;

	/**
	 * Inject the Category repository
	 * Inject the Offer repository
	 */
	public function __construct(Category $category, Offer $offer, User $user, Order $order)
	{
		$this->category = $category;
		$this->offer = $offer;
		$this->order = $order;
		$this->user = $user;

		/**
		 * Construct the PayPal stuff
		 */
		$paypal_conf = Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

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
		return View::make('offers.add', array('title' => 'Title', 'photo' => 'http://placehold.it/400x400', 'description' => 'Description', 'url' => 'URL', 'interests' => $this->category->all()));
	}

	/**
	 * Show the offer tracking view
	 */
	public function track()
	{
		$offers = $this->offer->offers(Auth::user()->id);
		$orders = [];
		for($i = 0;  $i < count($offers); $i++)
		{
			$orderSet = $this->order->orders($offers[$i]->id);
			array_push($orders, $orderSet);
			$offers[$i] = ['offer' => $offers[$i], 'orders' => $orderSet];
		}

		return View::make('offers.track')->with(['offers' => $offers]);
	}

	/**
	 * Show the individual offer view
	 */
	public function single($id)
	{
		$offer = $this->offer->find($id);
		$orders = $this->order->data($id);

		$offer = [
			'offer' => $offer,
			'orders' => $orders
		];

		return View::make('offers.single')->with(['offer' => $offer]);
	}

	/**
	 * Show the data view
	 */
	public function data($id)
	{
		return $this->order->data($id)['data'];
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
				'photo' => '/data-a-dynamic-image="{&quot;(.*?)&quot;/',
				'description' => '/%22productDescriptionWrapper%22%3E%0A(.*?)%3Ch3%20class%3D%22productDescriptionSource/',
				'alt_description' => '/%3D%22productDescriptionWrapper%22%3E%0A(.*?)%0A/'
			))->URLs($url)
			->callback(array(
				'_all_' => array('trim')
			));

			/**
			 * Make sure description exists
			 */
			$description = $cc->get()[0]['description'];
			if($description == "")
				$description = $cc->get()[0]['alt_description'];

			/**
			 * Return an array of the data
			 */
			$product = array(
				'photo' => $cc->get()[0]['photo'],
				'title' => $cc->get()[0]['title'],
				'description' => urldecode($description),
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
		$data = Input::except('interest');

		/**
		 * Create the offer
		 */

		$categories = Input::get('interest');
		$s = $this->offer->categories($data, $categories, Auth::user()->id);

		if($s)
			return Redirect::route('offers.track');
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

	/**
	 * Offer moderation
	 */
	public function moderate()
	{
		$offers = $this->offer->unmoderated();
		$categories = $this->offer->allCategories($offers);
		return View::make('admin.offers.moderate')->with('offers', $categories);
	}

	/**
	 * Approve an offer
	 */
	public function approve()
	{
		echo $this->offer->approve(Input::get('id'));
		return Redirect::to('offers/moderate')->with('approve', 'Offer #'.Input::get('id').' has been approved.');
	}

	/**
	 * Deny an offer
	 */
	public function deny()
	{
		echo $this->offer->deny(Input::get('id'));
		return Redirect::to('offers/moderate')->with('deny', 'Offer #'.Input::get('id').' has been denied.');
	}

	/**
	 * Place claim for shipping reimbursement
	 */
	public function claim()
	{
		/**
		 * Get amount claimed
		 */
		$cost = implode(".", [Input::get('dollars'), Input::get('cents')]);

		/**
		 * Get the order to associate
		 * the claim with
		 */
		$order = $this->order->find(Input::get('order'));
		
		echo $this->order->claim(Auth::user(), $order, $cost);
	}
}