@extends('layouts.email')

@section('heading')
Shipping Dispute Filed
@stop

@section('greeting')
Hi {{$name}},
@stop

@section('body')
Your shipping dispute has been filed. We will put a hold on the reimbursement until we have completed our review process.
<br>
<br> 
Cheers,
<br>
<br>
<em>Stuart Carter</em>
<br>
<br>
Cofounder, Business Development
<br>
<a href="mailto:stu@rayvr.com">stu@rayvr.com</a>
<br>
RAYVR
<br>
<a href="http://rayvr.com">www.rayvr.com</a>
@stop