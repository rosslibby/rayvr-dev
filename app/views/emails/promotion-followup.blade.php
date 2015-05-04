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
Would you like to run another promotion of the same product with RAYVR? EASY!
<br>
All you need to do is login to your RAYVR dashboard and 'Add Another Promotion'. Here's the best bit...we won't need to go through the pre-approval process this time, so your promotion can start immediately!
<br>
As you know, RAYVR offers only <strong>one type of each product</strong> at a time to our users so that they don't get the same thing offered to them too often. Therefore, we are pleased to let you know that if you want to run another promotion, we are happy to hold your product's exclusivity for 24 hours - to give you time to submit the promotion again.
<br>
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
<br>
<br> 
Kind regards,
<br>
<br>
<em>The RAYVR Business Team</em>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
RAYVR
<br>
<a href="https://rayvrbusiness.com">https://rayvrbusiness.com</a>
@stop