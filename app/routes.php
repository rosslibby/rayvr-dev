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

/**
 * Offer moderation by site moderators
 */
Route::get('offers/moderate', 'OffersController@moderate');
Route::post('offers/approve', [
	'uses' => 'OffersController@approve',
	'as' => 'offers.approve'
]);
Route::post('offers/deny', [
	'uses' => 'OffersController@deny',
	'as' => 'offers.deny'
]);

Route::group(['before' => 'csrf'], function()
{
/**	Route::get('/', [
		'uses' => 'LandingController@index',
		'as' => 'index'
	]);
*/
	/** temporary **/
	Route::get('/', [
		'uses' => 'SessionController@register',
		'as' => 'session.index'
	]);

	/**
	 * Preference routes
	 */
	Route::get('user/preferences', [
		'uses' => 'PreferencesController@index',
		'as' => 'user.preferences'
	]);
	Route::post('preferences', [
		'uses' => 'UserController@store',
		'as' => 'user.store'
	]);
	Route::get('welcome', 'RegisterController@welcome');

	/**
	 * User pages
	 */
	 Route::get('offers/current', function(){
	 	return View::make('offers.select');
	 });

	/**
	 * Business pages
	 */
	Route::get('business', function(){
		return View::make('business.index');
	});

/**	Route::get('register/{referral?}', [
		'uses' => 'SessionController@register',
		'as' => 'session.index'
	]);
*/
	/** temporary **/
	Route::get('register/{referral?}', [
		'uses' => 'LandingController@index',
		'as' => 'index'
	]);

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

	Route::get('welcome', [
		'uses' => 'RegisterController@welcome',
		'as' => 'register.welcome'
	]);

	Route::get('business/welcome', [
		'uses' => 'RegisterController@welcomeBusiness',
		'as' => 'business.welcome'
	]);

	Route::get('resources/privacy', function()
	{
		return View::make('resources.privacy');
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
	 * Password reset
	 */
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
	Route::get('login', array(
		'uses' => 'SessionController@create',
		'as' => 'session.create'
	));
	Route::post('login', array(
		'uses' => 'SessionController@store',
		'as' => 'session.store'
	));
	Route::get('logout', array(
		'uses' => 'SessionController@destroy',
		'as' => 'session.destroy'
	));

	Route::group(['before' => 'auth'], function()
	{
		/**
		 * Offers
		 */
		Route::post('offers/fetch', 'OffersController@fetch');

		Route::get('offers/add', 'OffersController@add');

		Route::post('offers', [
			'uses' =>  'OffersController@store',
			'as' => 'offers.store'
		]);

		Route::get('offers/track', [
			'uses' => 'OffersController@track',
			'as' => 'offers.track'
		]);

		Route::resource('offers', 'OffersController');

		/**
		 * Payments
		 */
		Route::get('payments', [
			'uses' => 'PaymentController@payments',
			'as' => 'payments'
		]);

		Route::get('payments/membership', [
			'uses' => 'PaymentController@membership',
			'as' => 'membership'
		]);

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
	});

	/**
	 * Referrals
	 */
	Route::resource('referrals', 'ReferralsController');
});