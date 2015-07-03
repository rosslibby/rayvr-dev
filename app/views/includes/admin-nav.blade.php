@extends('layouts.user-dashboard-master')

@section('topnav')
	<li class="fg-scheme-dark-gray anchor {{ Request::is('users') ? 'active' : '' }}"><a href="/users">Users</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('affiliates') ? 'active' : '' }}"><a href="/affiliates">Affiliates</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/all') ? 'active' : '' }}"><a href="/offers/all">All promotions <span class="badge badge-info">{{ count(Offer::all()) }}</span></a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/moderate') ? 'active' : '' }}"><a href="/offers/moderate">New promotions <span class="badge badge-danger">{{ count(Offer::where(['approved' => false, 'reason' => ''])->get()) }}</span></a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/active') ? 'active' : '' }}"><a href="/offers/active">Active promotions <span class="badge badge-success">{{ count(Offer::where('approved',true)->where('start','<=',date('Y-m-d'))->where('end', '>=', date('Y-m-d'))->get()) }}</span></a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('shipping/moderate') ? 'active' : '' }}"><a href="/shipping/moderate">Shipping claims <span class="badge badge-warning">{{ count(Order::where(['paid_shipping' => true, 'reimbursed' => false])->where('cost', '>', 0)->get()) }}</span></a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('feedback') ? 'active' : '' }}"><a href="/feedback">User Feedback <span class="badge badge-info">{{ count(Feedback::all()) }}</span></a></li>
	{{-- <li class="fg-scheme-dark-gray anchor {{ Request::is('discounts') ? 'active' : '' }}"><a href="/discounts">Discounts</a></li> --}}
@stop