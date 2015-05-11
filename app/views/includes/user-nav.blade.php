@extends('layouts.user-dashboard-master')
 
@section('topnav')
	{{-- If the user is not verified, show the "verify" button --}}
	{{-- Temporarily do not require verification --}}
	{{--
		@if(!Auth::user()->verified)
		<li class="fg-scheme-dark-gray anchor {{ Request::is('verify') ? 'active' : '' }}">{{ HTML::link('verify', 'Verify Your Address') }}</li>
		@endif
	--}}
	{{-- Show no navigation for an unverified user --}}
	@if(Auth::user()->verified)
		{{-- If the user has not completed his or her preferences, show only the preferences page --}}
		@if(Auth::user()->first_name && Auth::user()->last_name && Auth::user()->address && Auth::user()->country && Auth::user()->city && Auth::user()->zip)
		<li class="fg-scheme-dark-gray anchor {{ Request::is('promotions/current') ? 'active' : '' }}">{{ HTML::link('promotions/current', 'Current Promotions') }}</li>
		
		{{-- If the user has not verified his or her address, do not show the 'current offer' page --}}
		@endif
		<li class="fg-scheme-dark-gray anchor {{ Request::is('preferences') ? 'active' : '' }}">{{ HTML::link('preferences', 'Preferences') }}</li>
		<li class="fg-scheme-dark-gray anchor {{ Request::is('invite') ? 'active' : '' }}">{{ HTML::link('invite', 'Invite') }}</li>
		<li class="fg-scheme-dark-gray anchor {{ Request::is('support') ? 'active' : '' }}">{{ HTML::link('support', 'Support') }}</li>
	@endif
@stop