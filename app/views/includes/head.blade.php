<!doctype html>
<html lang="en">
<head>
	<title>Sign Up with RAYVR for Early Access</title>

	<!-- Load styles -->
	@include('includes.styles')

	<!-- Viewport -->
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<!-- For AJAX posting -->
	<meta name="_token" content="{{ csrf_token() }}" />
</head>
<body>
	<div class="wrapper">
	@include('includes.head-content')