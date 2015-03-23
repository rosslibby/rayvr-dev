@extends('layouts.user-dashboard-master')

@section('topnav')
	<li class="fg-scheme-dark-gray anchor {{ Request::is('users') ? 'active' : '' }}"><a href="/users">Users</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/moderate') ? 'active' : '' }}"><a href="/offers/moderate">New promotions <span class="badge badge-danger">{{ count(Offer::where('approved',false)->get()) }}</span></a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('offers/active') ? 'active' : '' }}"><a href="/offers/active">Active promotions <span class="badge badge-success">{{ count(Offer::where('approved',true)->where('start','<=',date('Y-m-d'))->where('end', '>=', date('Y-m-d'))->get()) }}</span></a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('shipping/moderate') ? 'active' : '' }}"><a href="/shipping/moderate">Shipping claims <span class="badge badge-warning">{{ count(Reimbursement::where('resolved',false)->get()) }}</span></a></li>
@stop