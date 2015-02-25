@extends('layouts.user-dashboard-master')

@section('topnav')
	<li class="fg-scheme-dark-gray anchor {{ Request::is('users') ? 'active' : '' }}"><a href="/users">Users</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/moderate') ? 'active' : '' }}"><a href="/offers/moderate">Moderate offers</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('shipping/moderate') ? 'active' : '' }}"><a href="/shipping/moderate">Shipping claims</a></li>
@stop