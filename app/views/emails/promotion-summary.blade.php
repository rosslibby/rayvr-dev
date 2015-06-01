@extends('layouts.email')

@section('heading')
Your RAYVR Promotion
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Your promotion for item "{{ $title }}" has ended (ID: {{ $promo_id }}). Here are the stats!
<br>
<br>
The number of promotions that were initially accepted by our users was {{ $ordered }}. 
<br>
<br>
Of those, {{ $confirmed }} have indicated that they have ordered the product and left either a review on Amazon or feedback with us. 
<br>
(Leaving feedback rather than an Amazon review is encouraged if there was a problem.)
<br>
<br>
Note: Users that have accepted the offer but not ordered yet may still do so.
<br>
<br>
A total of {{ $claimed }} claimed shipping charges that were reimbursed. Individual claims can be viewed by logging in.
<br> 
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we'll help you out any way we can.
<br>
Thank you for being part of RAYVR!
@stop