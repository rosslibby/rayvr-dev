<li class="{{ Request::is('offers/add') ? 'active' : '' }}"><a href="/offers/add"><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;&nbsp;&nbsp;New Offer</a></li>
<li class="{{ Request::is('offers/track') ? 'active' : '' }}"><a href="/offers/track"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;&nbsp;&nbsp;Track Offers</a></li>
<li class="{{ Request::is('offers/claims') ? 'active' : '' }}"><a href="/offers/claims"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;&nbsp;&nbsp;Shipping Claims</a></li>
<li class="{{ Request::is('offers/purchase') ? 'active' : '' }}"><a href="/offers/purchase"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;&nbsp;&nbsp;Purchase Offers</a></li>
<li class="{{ Request::is('payments') ? 'active' : '' }}"><a href="/payments"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;&nbsp;&nbsp;Payments</a></li>
<li class="{{ Request::is('messages') ? 'active' : '' }}"><a href="/messages"><span class="glyphicon glyphicon-inbox"></span>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
<li class="{{ Request::is('settings') ? 'active' : '' }}"><a href="/settings"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;&nbsp;&nbsp;Settings</a></li>