@extends('layouts.email')

@section('heading')
We were unable to approve your promotion
@stop

@section('heading-accent')
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Unfortunately your product was not approved for promotion on RAYVR.
<br>
<br>
You will not be charged by RAYVR. Thank you for your interest in our program. 
<br>
<br>
However, if you have more products that you would like to promote, please feel free to do so by logging into your RAYVR dashboard and selecting 'New Promotion'.
<br>
<br>
Questions?
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
@stop