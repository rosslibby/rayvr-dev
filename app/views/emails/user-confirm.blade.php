@extends('layouts.email')

@section('heading')
Confirm Your Account
@stop

@section('heading-accent')
@stop

@section('greeting')
Please confirm your email by clicking the link below.
@stop

@section('body')
{{ HTML::link('https://rayvr.com/account/confirm/'.$confirm.'/'.$email, 'https://rayvr.com/account/confirm/'.$confirm.'/'.$email) }}
<br>
<br>
If you did not request this to be part of RAYVR, please disregard this email.
<br>
<br>
For support, please contact us: {{ HTML::link('mailto:support@rayvr.com', 'support@rayvr.com') }}
@stop