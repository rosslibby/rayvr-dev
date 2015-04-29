@extends('layouts.email')

@section('heading')
We were unable to approve your offer
@stop

@section('heading-accent')
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
Your product was not approved due to the following reasons:
<br>
{{ $reason }}
<br>
Contact us with any questions.
<br>
<br> 
Best,
<br>
<br>
<em>Stuart Carter</em>
<br>
<br>
Cofounder, Business Development
<br>
<a href="mailto:stu@rayvr.com">stu@rayvr.com</a>
<br>
RAYVR
<br>
<a href="http://rayvr.com">www.rayvr.com</a>
@stop