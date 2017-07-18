<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-theme.min.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap-material-design/css/bootstrap-material-design.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<script src="{{asset('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendor/bootstrap-material-design/js/material.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
</head>
<body>

@yield('header')
<article>
	<!--@yield('modal')
	@yield('chart')
	@yield('tabs')-->
	@yield('content')
</article>



</body>
</html>
@yield('external-script')
