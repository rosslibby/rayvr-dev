{{-- Select all offers associated with the business --}}
{{--*/ $offers =  Offer::where('business_id',Auth::user()->id)->where('approved',true)->get() /*--}}

{{-- If the business has any approved offers, show the entire menu --}}
@if(!empty(json_decode($offers)))
<li class="{{ Request::is('promotions/track*') ? 'active' : '' }}"><a href="/offers/track"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;&nbsp;&nbsp;Track Promotions</a></li>
@endif
@if(Auth::user()->stripe_customer)
	{{-- @if(!empty(json_decode($offers))) --}}
		<li class="{{ Request::is('promotions/new') ? 'active' : '' }}"><a href="/offers/add"><i class="fa fa-tag"></i>&nbsp;&nbsp;&nbsp;&nbsp;New Promotion</a></li>
	{{-- @endif --}}
@endif
{{-- Always show the Preferences and Support options --}}
<li class="{{ Request::is('settings') ? 'active' : '' }}"><a href="/settings"><i class="fa fa-wrench"></i>&nbsp;&nbsp;&nbsp;&nbsp;Preferences</a></li>
{{-- If the preferences have been completed, show the "billing" form --}}
@if(Auth::user()->first_name && Auth::user()->last_name && Auth::user()->email && Auth::user()->address && Auth::user()->city && Auth::user()->country && Auth::user()->zip && Auth::user()->phone)
	<li class="{{ Request::is('billing') ? 'active' : '' }}"><a href="/billing"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp;&nbsp;Billing</a></li>
@endif
<li class="{{ Request::is('business-contact') ? 'active' : '' }}"><a href="/business-contact"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;Support</a></li>