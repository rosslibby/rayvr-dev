@extends('layouts.email')

@section('heading')
Account Deactivated
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
We’re sorry to see you go! If you have any questions please do not hesitate to reach out.
<br>
<br>
Regards,
<br>
<br>
<em>The RAYVR Team</em>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
<a href="https://rayvr.com">https://rayvr.com</a>
@stop