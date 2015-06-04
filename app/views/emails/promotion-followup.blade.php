@extends('layouts.email')

@section('heading')
Start another promotion!
@stop

@section('greeting')
Hi {{ $first_name }},
@stop

@section('body')
Congratulations on your first promotion with RAYVR!
<br>
<br>
<strong>Start another promotion!</strong>
<br>
<br>
Would you like to run another promotion of the <strong>same product</strong> with RAYVR? EASY!
<br>
<br>
All you need to do is login to your RAYVR dashboard and select 'New Promotion'. Here's the best bit...we won't need to go through the pre-approval process this time, so your promotion can start immediately!
<br>
As you know, RAYVR offers only <em>one type of each product</em> at a time to our users so that they don't get the same thing offered to them too often. Therefore, we are pleased to let you know that if you want to run another promotion, we are happy to hold your product's exclusivity for 24 hours - to give you time to submit the promotion again.
<br>
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
@stop