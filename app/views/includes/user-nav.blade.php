@extends('layouts.user-dashboard-master')

@section('topnav')
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/current') ? 'active' : '' }}"><a href="/offers/current">Current Offer</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('preferences') ? 'active' : '' }}"><a href="/preferences">Preferences</a></li>
@stop