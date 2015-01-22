@extends('layouts.dashboard-master')

@section('sidebar')
	<li><a href="/add-offer"><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;&nbsp;&nbsp;Add Offer</a></li>
	<li><a href="/track-offers"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;&nbsp;&nbsp;Track Offers</a></li>
	<li><a href="/shipping-claims"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;&nbsp;&nbsp;Shipping Claims</a></li>
	<li><a href="/purchase-offers"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;&nbsp;&nbsp;Purchase Offers</a></li>
	<li><a href="/payments"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;&nbsp;&nbsp;Payments</a></li>
	<li><a href="/messages"><span class="glyphicon glyphicon-inbox"></span>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
	<li><a href="/settings"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;&nbsp;&nbsp;Settings</a></li>
@stop