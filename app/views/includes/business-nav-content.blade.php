<li class="{{ Request::is('promotions/track*') ? 'active' : '' }}">
	<a href="/promotions/track">
		<i class="fa fa-bar-chart"></i>
		<span>Track Promotions</span>
		<span class="label label-primary pull-right">{{ count($user->offers) }}</span>
	</a>
</li>
<li class="{{ Request::is('promotions/new') ? 'active' : '' }}">
	<a href="/promotions/new">
		<i class="fa fa-tag"></i>
		<span>Add Promotion</span>
		<i class="fa fa-plus pull-right"></i>
	</a>
</li>
<li class="{{ Request::is('settings') ? 'active' : '' }}">
	<a href="/settings">
		<i class="fa fa-gear"></i>
		<span>Preferences</span>
		<i class="fa fa-chevron-right pull-right"></i>
	</a>
</li>
<li class="{{ Request::is('billing') ? 'active' : '' }}">
	<a href="/billing">
		<i class="fa fa-credit-card"></i>
		<span>Billing</span>
		<i class="fa fa-chevron-right pull-right"></i>
	</a>
</li>
<li class="{{ Request::is('business-contact') ? 'active' : '' }}">
	<a href="/business-contact">
		<i class="fa fa-phone"></i>
		<span>Support</span>
		<i class="fa fa-chevron-right pull-right"></i>
	</a>
</li>