@extends('layouts.email')

@section('heading')
Your Promotion Has Been Approved!
@stop

@section('heading-accent')
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Your product has passed our quality testing and will be able to hold product exclusivity for category: {{ $category }}. Congratulations.
<br>
<br>
Details:
<br>
Your promotion will start on the date that you specified. Please make sure that your promotion code is for 100% off and that you have enough inventory in stock.
<br>
If you have selected ‘single-use’ codes (recommended) then we will send an individual code out to each of our users. If you have uploaded a multi-use coupon code (not recommended) then we will be sending out the same code to all users. Please refer to our terms of service {TOS} for further information.
<br>
<br>
What does ‘Exclusivity’ mean?
<br>
You’re the only one who can offer a {{ $category }}, or something we consider to be too similar in type, to our users! You have EXCLUSIVITY on RAYVR while your promotion is active.
<br>
<br>
What will I be charged?
<br>
We will only charge you once per promotion. This charge will include two possibilities. You will see one total charge, which is comprised of accepted promotions as well as shipping claims.
<br>
We charge the total number of accepted promotions by our users. For example, if you have 50 users out of 57 possibilities then we will charge you for only 50 accepted promotions.
<br>
If our users were charged shipping and wish to be reimbursed, then we will reimburse them for their shipping costs. They are required to submit their order confirmation number and the amount that they have been charged. You will then have 48 hours to review the shipping refund request before we reimburse our user. For more information on this please view our FAQ and Terms of Service page.
<br>
<br>
<strong>More Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions about your promotion, need to change the date, or update 
the coupon code(s), please get in touch by replying to this email or submitting the ‘contact us’ form at rayvr.com and we’ll 
help you out any way we can.
@stop