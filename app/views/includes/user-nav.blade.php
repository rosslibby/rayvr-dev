@extends('layouts.user-dashboard-master')

@section('topnav')
	{{-- If the user has not completed his or her preferences, show only the preferences page --}}
	@if(Auth::user()->first_name && Auth::user()->last_name && Auth::user()->address && Auth::user()->country && Auth::user()->city && Auth::user()->zip)
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/current') ? 'active' : '' }}">{{ HTML::link('offers/current', 'Current Offer') }}</li>
	@endif
	<li class="fg-scheme-dark-gray anchor {{ Request::is('preferences') ? 'active' : '' }}">{{ HTML::link('preferences', 'Preferences') }}</li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('invite') ? 'active' : '' }}">{{ HTML::link('invite', 'Invite') }}</li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('support') ? 'active' : '' }}">{{ HTML::link('support', 'Support') }}</li>
@stop