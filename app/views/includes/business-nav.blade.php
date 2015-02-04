@extends('layouts.dashboard-master')

@section('topnav')
	<li class="{{ Request::is('offers/track') ? 'active' : '' }}"><a href="/offers/track">Track Offers</a></li>
	<li class="{{ Request::is('offers/add') ? 'active' : '' }}"><a href="/offers/add">Add Offer</a></li>
	<li class="{{ Request::is('offers/claims') ? 'active' : '' }}"><a href="/offers/claims">Shipping Claims</a></li>
	<li class="{{ Request::is('offers/purchase') ? 'active' : '' }}"><a href="/offers/purchase">Purchase Offers</a></li>
	<li class="{{ Request::is('settings') ? 'active' : '' }}"><a href="/settings">Preferences</a></li>
@stop