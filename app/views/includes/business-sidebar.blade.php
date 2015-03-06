{{-- Select all offers associated with the business --}}
{{--*/ $offers =  Offer::where('business_id',Auth::user()->id)->where('approved',true)->get() /*--}}

{{-- If the business has any approved offers, show the entire menu --}}
@if(!empty(json_decode($offers)))
<li class="{{ Request::is('offers/track*') ? 'active' : '' }}"><a href="/offers/track"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;&nbsp;&nbsp;Track Offers</a></li>
<li class="{{ Request::is('offers/purchase') ? 'active' : '' }}"><a href="/offers/purchase"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;&nbsp;&nbsp;Offer Packs</a></li>
<li class="{{ Request::is('payments') ? 'active' : '' }}"><a href="/payments"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;&nbsp;&nbsp;Payments</a></li>
@endif

{{-- If the preferences have been completed, show the "add offer" form --}}
@if(Auth::user()->first_name && Auth::user()->last_name && Auth::user()->email && Auth::user()->address && Auth::user()->city && Auth::user()->country && Auth::user()->zip && Auth::user()->phone)
	<li class="{{ Request::is('offers/add') ? 'active' : '' }}"><a href="/offers/add"><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;&nbsp;&nbsp;New Offer</a></li>
@endif
{{-- Always show the Preferences and Support options --}}
<li class="{{ Request::is('settings') ? 'active' : '' }}"><a href="/settings"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;&nbsp;&nbsp;Settings</a></li>
<li><a href="/contact"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;Support</a></li>