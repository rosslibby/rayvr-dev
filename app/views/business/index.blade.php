@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	{{ HTML::image( 'resources/img/business/ad/35-percent-off.png', 'Get 35% Off Your Next Order of 50 Offers Or More', array('width' => '1000') ) }}
@stop