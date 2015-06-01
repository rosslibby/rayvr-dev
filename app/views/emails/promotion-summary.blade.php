@extends('layouts.email')

@section('heading')
Your RAYVR Promotion
@stop

@section('greeting')
Your promotion has ended for the RAYVR promotion ID: {{ $promo_id }}. Here are the stats!
@stop

@section('body')
The number of promotions that were initially accepted by our users was {{ $ordered }}. 
<br>
<br>
Of those, {{ $confirmed }} have indicated that they have ordered the product and left either a review on Amazon or feedback with us. 
<br>
(Leaving feedback rather than a review is encouraged if there was a problem.)
<br>
<br>
Note: Users that have accepted the offer but not ordered yet may still do so.
<br>
<br>
A total of {{ $claimed }} claimed shipping charges that were reimbursed.
<br> 
<br>
Thank you for being part of RAYVR!
@stop