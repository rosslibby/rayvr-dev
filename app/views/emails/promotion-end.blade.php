@extends('layouts.email')

@section('heading')
Your Rayvr Promotion Has Been Completed!
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Your promotion, "{{ $title }}" has now been completed and has had <strong>{{ $accepted }}</strong> people accept it. For more information, log in to your <a href="https://rayvrbusiness.com">RAYVR dashboard</a>. We will charge your credit card accordingly.
<br>
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we'll help you out any way we can.
<br>
Kind regards,
<br>
<br>
RAYVR Business Team
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
<a href="https://rayvrbusiness.com">https://rayvrbusiness.com</a>
@stop