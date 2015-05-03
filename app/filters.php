<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

Route::filter('verify', function()
{
	if (Auth::user())
	{
		if (!Auth::user()->verified && !Auth::user()->business)
		{
			$user = Auth::user();
			/**
			 * Temporarily remove postcard
			 * authentication requirement
			 */
			// if($user->postcard_sent)
			// {
			// 	return Redirect::to('verify');
			// }
		}
	}
});

Route::filter('confirm', function()
{
	if (Auth::user())
	{
		if (!Auth::user()->verified && Auth::user()->active == 3)
		{
			$user = Auth::user();
			if(!$user->postcard_sent)
			{
				return Redirect::to('admin/confirm');
			}
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/**
 * Active status is as follows:
 * 0: inactive
 * 1: user
 * 2: business
 * 3: administrator
 */
Route::filter('admin', function(){
	if(Auth::user())
	{
		if(Auth::user()->active != 3)
			return Redirect::to('/');
	}
	else
	{
		return Redirect::to('/');
	}
});
Route::filter('business', function(){
	if(!Auth::user()->active || !Auth::user()->business)
		return Redirect::to('/');
});
Route::filter('user', function(){
	if(Auth::user())
	{
		if(Auth::user()->active != 1)
			return Redirect::to('/');
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function($route, $request)
{
	/**
	 * Following line added to enable AJAX requests
	 */
	if(strtoupper($request->getMethod()) === 'GET')
	{
		return; // get requests are not CSRF protected
	}

	$token = $request->header('X-CSRF-Token') ?: Input::get('_token');

	if (Session::token() !== $token)
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
