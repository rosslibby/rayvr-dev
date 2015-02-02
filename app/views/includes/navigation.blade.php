<div class="collapse navbar-collapse navbar-right">
	<a href="login" class="navbar-btn navbar-right btn btn-primary">&nbsp;&nbsp;SIGN IN&nbsp;&nbsp;</a>
</div>
<ul class="nav navbar-nav navbar-right">
	<li class="fg-scheme-dark-gray anchor {{ Request::is('/') ? 'active' : '' }}"><a href="/">HOME</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('about') ? 'active' : '' }}"><a href="/about">HOW IT WORKS</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('register') ? 'active' : '' }}"><a href="/register">REGISTER</a></li>
	<li class="fg-scheme-dark-gray anchor {{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">CONTACT</a></li>
</ul>