@extends('layouts.email')

@section('heading')
RAYVR Password Reset
@stop

@section('heading-accent')
@stop

@section('greeting')
@stop

@section('body')
You have requested to reset your password. To reset your password, click on the link below. 
<br>
<br>
<a href="{{ $link }}">{{ $link }}</a>
<br>
<br>
If you did not request to reset your password, please disregard this email.
<br>
<br>
For further support, please contact us: <a href="mailto:support@rayvr.com">support@rayvr.com</a>
@stop