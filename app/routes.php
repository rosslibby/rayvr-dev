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
 * Handle active nav items
 */
HTML::macro('clever_link', function($route, $text){
	if( Request::path() == $route )
	{
		$active = "class = \"fg-scheme-dark-gray anchor active\"";
	} else {
		$active = "class = \"fg-scheme-dark-gray anchor\"";
	}
	return '<li '. $active . '>' . link_to($route, $text) . '</li>';
});

Route::group(['before' => 'csrf'], function()
{
	Route::get('/', function(){
		return View::make('landing.home');
	});

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
	 * Business pages
	 */
	Route::get('business', function(){
		return View::make('business.index');
	});

	Route::get('register/{referral?}', [
		'uses' => 'SessionController@register',
		'as' => 'session.index'
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

	Route::get('resources/privacy', function()
	{
		return View::make('resources.privacy');
	});

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
	 * Referrals
	 */
	Route::resource('referrals', 'ReferralsController');
});