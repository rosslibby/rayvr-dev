@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		<!-- Number of users -->
		{{-- */ $musers = User::where(['active' => 1, 'business' => false, 'gender' => true])->get(); $fusers = User::where(['active' => 1, 'business' => false, 'gender' => false])->get(); /* --}}
		Number of users: <strong>{{ count($musers) + count($fusers) }}</strong>
		<hr>
		% M/F Users: <strong>{{ 100/(count($musers) + count($fusers)) * count($musers) }}/{{ 100/(count($musers) + count($fusers)) * count($fusers) }}</strong>
		<hr>
		Number of businesses: <strong>{{ count(User::where(['active' => 1, 'business' => true])->get()) }}</strong>
	</div>
</div>
@stop