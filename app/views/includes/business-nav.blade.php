@extends('layouts.dashboard-master')

@section('topnav')
	<li class="{{ Request::is('offers/track*') ? 'active' : '' }}"><a href="/offers/track">Track Promotions</a></li>
	<li class="{{ Request::is('offers/add') ? 'active' : '' }}"><a href="/offers/add">Add Promotion</a></li>
	<li class="{{ Request::is('offers/purchase') ? 'active' : '' }}"><a href="/offers/purchase">Promotion Packs</a></li>
	<li class="{{ Request::is('settings') ? 'active' : '' }}"><a href="/settings">Preferences</a></li>
@stop