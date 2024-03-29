<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('register/welcome', [
	'uses' => 'RegisterController@welcome',
	'as' => 'register.welcome'
]);

/**
 * Route for testing anything
 */
// Route::get('test', function(){
// 	return View::make('business.new')->with('user', User::find(68));
// });

Route::group(['before' => 'csrf'], function()
{
	/**
	 * Business pages
	 */
	Route::group(['domain' => $_ENV['DOMAIN']], function(){
		Route::get('business/{referral?}', [
			'uses' => 'SessionController@register',
			'as' => 'session.index'
		]);
		if(!Auth::user())
		{
			Route::get('/', function(){
				return Redirect::to('business');
			});
		}

		/**
		 * Business-specific routes
		 */

		Route::group(['before' => 'business'], function(){

			/**
			 * Business FAQ
			 */
			Route::get('business/faq', function(){
				return View::make('resources.business-faq');
			});

			/**
			 * Dispute shipping claim
			 */
			Route::get('orders/{order}/shipping', function($order){
				$order = Order::find($order);
				return View::make('orders.shipping-claim')->with('claim', $order->reimbursement);
			});
			Route::post('orders/{order}/shipping', 'OrderController@dispute');

			/**
			 * Delete credit card
			 */
			Route::get('card/{id}/delete', [
				'uses' => 'PaymentController@delete',
				'as' => 'card.delete'
			]);

			/**
			 * Promotions ordered
			 */
			Route::get('promotions/track/{id}', [
				'uses' => 'OffersController@single',
				'as' => 'offers.single'
			]);

			/**
			 * Image uploader
			 */
			Route::get('offer/image', function(){
				return View::make('offers.image-upload');
			});
			Route::post('offer/image', function(){
				$file = Input::file('image');
				$extension = ".".$file->getClientOriginalExtension();
				$destinationPath = public_path().'/uploads/';
				$filename = "OfferTitle-".str_random(14)."-".microtime(true).$extension;
				Input::file('image')->move($destinationPath, $filename);
			});

			/**
			 * Shipping document uploader
			 */
			Route::get('order/{order}/dispute', 'OrderController@shippingDoc');
			Route::post('order/{order}/dispute', 'OrderController@shippingSave');

			/**
			 * Offer-pack routes
			 */
			Route::get('offers/purchase', 'PaymentController@offers');
			Route::post('offers/purchase', [
				'uses' => 'PaymentController@payForOffers',
				'as' => 'offers/purchase'
			]);

			/**
			 * Billing portal
			 */
			Route::get('billing', [
				'uses' => 'PaymentController@billing',
				'as' => 'billing'
			]);
			Route::post('billing', [
				'uses' => 'PaymentController@subscribe',
				'as' => 'payments'
			]);
			Route::post('promotions/new/billing', [
				'uses' => 'PaymentController@subscribe',
				'as' => 'promotion.billing'
			]);

			/**
			 * Pay shipping deposit
			 */
			Route::get('offers/track/{id}/deposit', 'OffersController@deposit');

			/**
			 * Process shipping deposit
			 */
			Route::get('offers/shipping/deposit', 'OffersController@processDeposit');
		});
	});

	/**
	 * Administrator-specific routes
	 */
	/**
	 * Confirm that user is an admin
	 */
	Route::get('admin/confirm/{confirm}/{email}', function($confirm, $email){
		/**
		 * Find user where email = $email and
		 * where confirm = $confirm
		 */
		$user = User::where(['email' => $email, 'confirm' => $confirm])->get();
		if($user[0]->id)
		{
			$user[0]->verified = true;
			$user[0]->save();
			return Redirect::to('/');
		}
	});
	Route::group(['before' => 'admin'], function(){

		/**
		 * Admin confirmation page
		 */
		Route::get('admin/confirm', function(){
			echo "If you haven't received your account confirmation email, <a href=\"sendconfirm\">click here</a> to resend it.";
		});
		/**
		 * Send admin confirmation email
		 */
		Route::get('admin/sendconfirm', function(){
			$user = Auth::user();
			Mail::send('emails.admin-confirm', ['name' => $user->first_name.' '.$user->last_name, 'from' => 'The RAYVR team', 'confirm' => $user->confirm, 'email' => $user->email], function($message) use ($user)
			{
				$message->to($user->email)->subject('Confirm your email address');
			});
			return "Check your email and click the confirmation link that we sent.";
		});

		Route::group(['before' => 'confirm'], function(){

			/**
			 * Administrator control page
			 */
			Route::get('admin/control', 'AdminController@index');

			/**
			 * View users
			 */
			Route::get('users', function(){
				return View::make('admin.users')->with('users', User::paginate(20));
			});

			/**
			 * View user's feednack
			 */
			Route::get('feedback', function(){
				return View::make('admin.feedback')->with('comments', Feedback::paginate(5));
			});

			/**
			 * View affiliates
			 */
			Route::get('affiliates', 'AdminController@affiliates');
			Route::post('affiliates', [
				'uses' => 'AdminController@newAffiliate',
				'as' => 'affiliates'
			]);

			/**
			 * View all offers
			 */
			Route::get('offers/all', 'AdminController@offers');

			/**
			 * View active offers
			 */
			Route::get('offers/active', 'AdminController@active');

			/**
			 * View individual offer
			 */
			Route::get('offers/view/{offer}', 'AdminController@single');

			/**
			 * View individual user
			 */
			Route::get('users/{id}', 'AdminController@user');

			/**
			 * Change user account
			 * type (business/user)
			 */
			Route::get('users/{id}/type', function($id){
				return View::make('user.account-type')->with('id', $id);
			});
			Route::post('users/{id}/type', 'UserController@type');

			/**
			 * Suspend user
			 */
			Route::get('users/suspend/{id}', [
				'uses' => 'UserController@suspend',
				'as' => 'user.suspend'
			]);

			Route::get('users/{id}/delete', [
				'uses' => 'UserController@delete',
				'as' => 'user.delete'
			]);

			/**
			 * Manage discount codes
			 */
			Route::get('discounts', 'AdminController@showDiscounts');
			Route::post('discounts', [
				'uses' => 'AdminController@discounts',
				'as' => 'discounts'
			]);

			/**
			 * Offer moderation by site moderators
			 */
			Route::get('offers/moderate', 'OffersController@moderate');
			Route::get('offers/approve/{id?}', 'OffersController@approveConfirm');
			Route::post('offers/approve', [
				'uses' => 'OffersController@approve',
				'as' => 'offers.approve'
			]);

			Route::get('offers/deny/{id?}', 'OffersController@denyConfirm');
			Route::post('offers/deny', [
				'uses' => 'OffersController@deny',
				'as' => 'offers.deny'
			]);

			/**
			 * Shipping moderation
			 */
			Route::get('shipping/moderate', 'OrderController@moderateShipping');
			Route::post('shipping/moderate', 'OrderController@approveShipping');

			/**
			 * Stop offer
			 */
			Route::get('offers/{id}/stop', 'OffersController@stopPromo');

			/**
			 * Delete the offer
			 */
			Route::get('offers/delete/{id}', 'OffersController@deletePromo');
		});
	});

	/**
	 * User-specific routes
	 */
	Route::get('account/confirm/{confirm}/{email}', function($confirm, $email){
		/**
		 * Find user where email = $email and
		 * where confirm = $confirm
		 */
		$user = User::where(['email' => $email, 'confirm' => $confirm])->get();
		if($user[0]->id)
		{
			$user[0]->verified = true;
			$user[0]->save();
			return Redirect::to('/');
		}
	});
	Route::group(['before' => 'user'], function(){

		/**
		 * Send user account confirmation email
		 */
		Route::get('user/sendconfirm', function(){
			$user = Auth::user();
			Mail::send('emails.user-confirm', ['name' => null, 'from' => 'The RAYVR team', 'confirm' => $user->confirm, 'email' => $user->email], function($message) use ($user)
			{
				$message->to($user->email)->subject('Confirm your email address');
			});
			return Redirect::to('verify')->with('success', 'Check your email for your confirmation code');
		});

		/**
		 * User support page
		 */
		Route::get('support', function(){
			return View::make('user.support');
		});

		/**
		 * Invite your friends page
		 */
		Route::get('invite/{referral?}', [
			'uses' => 'UserController@invite',
			'as' => 'invite'
		]);

		Route::post('invite', [
			'uses' => 'UserController@sendInvite',
			'as' => 'sendinvite'
		]);

		Route::group(['before' => 'verify'], function(){

			/**
			 * User offer selector
			 */
			// Route::get('offers/current', [
			// 	'uses' => 'UserController@matches',
			// 	'as' => 'offers.current'
			// ]);
			// Route::post('offers/current', 'UserController@accept');
			Route::get('promotions/current', [
				'uses' => 'UserController@matches',
				'as' => 'offers.current'
			]);
			Route::post('promotions/current', 'UserController@accept');
			Route::get('offers/current', function()
			{
				return Redirect::to('promotions/current');
			});

			/**
			 * Shipping reimbursement claims
			 */
			Route::get('offers/{offer}/shipping/{order?}', function($offer, $order = null){
				return View::make('offers.shipping')->with('order', $order);
			});
			Route::post('offers/shipping', [
				'uses' => 'OffersController@claim',
				'as' => 'shipping.claim'
			]);

			/**
			 * Confirm order with
			 * confirmation code
			 */
			Route::get('order/confirm', function(){
				return View::make('orders.confirm');
			});
			Route::post('order/confirm', 'OrderController@confirm');

			/**
			 * Confirm whether user
			 * paid for shipping
			 */
			Route::get('order/shipping', function(){
				return View::make('orders.shipping');
			});
			Route::post('order/shipping', 'OrderController@shipping');

			/**
			 * Leave feedback for offer
			 */
			Route::get('promotions/feedback', [
				'uses' => 'OrderController@feedback',
				'as' => 'promotions.feedback'
			]);
			Route::post('promotions/feedback', 'OrderController@saveFeedback');

			/**
			 * Confirm review with
			 * review URL
			 */
			Route::get('order/review', [
				'uses' => 'OrderController@leavereview',
				'as' => 'order.review'
			]);
			Route::post('order/review', 'OrderController@review');

			/**
			 * User preferences
			 */
			Route::get('preferences', [
				'uses' => 'PreferencesController@user',
				'as' => 'user.preferences'
			]);
			Route::post('preferences', [
				'uses' => 'PreferencesController@storeUser',
				'as' => 'user.storePreferences'
			]);

			Route::post('deactivate', [
				'uses' => 'UserController@deactivate',
				'as' => 'deactivate'
			]);
		});

			Route::get('verify', function()
			{
				return View::make('user.verify');
			});
			Route::post('verify', [
				'uses' => 'UserController@verify',
				'as' => 'verify'
			]);
	});

	/**
	 * Home page without invite code
	 */
	Route::get('/', [
		'uses' => 'LandingController@index',
		'as' => 'index'
	]);

	/**
	 * Home page with invite code
	 */
	Route::get('register/{referral?}', [
		'uses' => 'LandingController@index',
		'as' => 'index'
	]);

	/** temporary **/
/**	Route::get('/', [
		'uses' => 'SessionController@register',
		'as' => 'session.index'
	]);
*/

	/** temporary **/
/**	Route::get('register/{referral?}', [
		'uses' => 'LandingController@index',
		'as' => 'index'
	]);
*/
	Route::get('early/{referral?}', [
		'uses' => 'RegisterController@early',
		'as' => 'register.early'
	]);

	Route::post('early', [
		'uses' => 'RegisterController@earlyStore',
		'as' => 'register.earlystore'
	]);

	Route::post('register', [
		'uses' => 'RegisterController@store',
		'as' => 'register.store'
	]);

	Route::get('business/welcome', [
		'uses' => 'RegisterController@welcomeBusiness',
		'as' => 'business.welcome'
	]);

	Route::get('resources/privacy', function()
	{
		return View::make('resources.privacy');
	});

	Route::get('faq', function(){
		return View::make('resources.user-faq');
	});

	Route::get('resources/terms-and-conditions', function()
	{
		return View::make('resources.terms-and-conditions');
	});

	/**
	 * Contact page
	 */
	Route::get('contact', [
		'uses' => 'LandingController@contact',
		'as' => 'landing.contact'
	]);

	Route::post('contact', [
		'uses' => 'ContactController@primary',
		'as' => 'contact.primary'
	]);

/**
	 * Business Contact page
	 */
	Route::get('business-contact', [
		'uses' => 'LandingController@businesscontact',
		'as' => 'landing.business-contact'
	]);

	/**
	 * Password reset
	 */
	Route::get('account/reset', 'UserController@requestReset');
	Route::post('account/reset', [
		'uses' => 'UserController@sendResetRequest',
		'as' => 'account/reset'
	]);
	Route::get('reset/{email}/{invite_code}/{confirm}', function($email, $code, $confirm){
		$vars = ['email' => $email, 'code' => $code, 'confirm' => $confirm];
		return View::make('user.reset')->with('vars', $vars);
	});

	Route::post('reset', [
		'uses' => 'UserController@reset',
		'as' => 'reset'
	]);

	/**
	 * Session routes
	 */
	Route::get('login', [
		'uses' => 'SessionController@create',
		'as' => 'session.create'
	]);
	Route::post('login', [
		'uses' => 'SessionController@store',
		'as' => 'session.store'
	]);
	Route::get('logout', [
		'uses' => 'SessionController@destroy',
		'as' => 'session.destroy'
	]);

	Route::group(['before' => 'auth'], function()
	{
		/**
		 * Offers
		 */
		Route::post('promotions/fetch', 'OffersController@fetch');


		Route::get('offers/add', function()
		{
			//use new naming conventions
			return Redirect::to('promotions/new');
		});

		Route::get('promotions/new', [
			'uses' => 'OffersController@add',
			'as' => 'offers.add'
		]);

		Route::get('offers/billing', function()
		{
			//use new naming conventions
			return Redirect::to('promotions/new/billing');
		});

		Route::get('promotions/new/billing', 'OffersController@billing');

		/**
		 * Select credit card as billing method
		 */
		Route::get('billing/{id}/{offer}/select', [
			'uses' => 'OffersController@chooseBilling',
			'as' => 'billing.select'
		]);

		Route::post('promotions/add', [
			'uses' => 'OffersController@quota',
			'as' => 'offers.quota'
		]);

		Route::post('offers/quota', [
			'uses' =>  'OffersController@store',
			'as' => 'offers.store'
		]);

		Route::get('offers/track', function()
		{
			//use new naming conventions
			return Redirect::to('promotions/track');
		});

		Route::get('promotions/track', [
			'uses' => 'OffersController@track',
			'as' => 'offers.track'
		]);

		/**
		 * "We are reviewing your offer" landing page
		 */
		Route::get('offers/review', function(){
			return View::make('offers.review');
		});

		Route::resource('offers', 'OffersController');

		/**
		 * Payments
		 */

		/**
		 * Preferences
		 */
		Route::get('settings', [
			'uses' => 'PreferencesController@business',
			'as' => 'business.preferences'
		]);

		Route::post('settings', [
			'uses' => 'PreferencesController@storeBusiness',
			'as' => 'preferences.storeBusiness'
		]);

		Route::get('offers/purchase', 'PaymentController@offers');
		Route::post('offers/purchase', [
			'uses' => 'PaymentController@payForOffers',
			'as' => 'offers/purchase'
		]);
	});

	/**
	 * Referrals
	 */
	Route::resource('referrals', 'ReferralsController');
});