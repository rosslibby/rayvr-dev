@extends('layouts.email')

@section('heading')
Welcome to
@stop

@section('heading-accent')
RAYVR
@stop

@section('greeting')
You're our newest member!
@stop

@section('body')
Congratulations on joining RAYVR.
<br>
<br>
We're working away to ensure we have top-notch products ready to go for our launch.
<br>
<br>
Stayt tuned - you'll be receiving an email about your first offer in the next few weeks.
<br>
<br>
Want to share the love?
<br>
<a href="http://rayvr.com/invite/{{ $code }}">Send your friends an early invite to join RAYVR today (click here)</a>.
<br>
<br>
Best,
<br>
<br>
<em>Ben Katzaman</em>
<br>
<br>
Cofounder, Community Development
<br>
<a href="mailto:ben@rayvr.com">ben@rayvr.com</a>
<br>
RAYVR
<br>
<a href="http://rayvr.com">www.rayvr.com</a>
@stop