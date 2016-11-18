<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-theme.min.css')}}"/>
	<script src="{{asset('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
</head>
<body>

@yield('header')
<article class="container">
	<!--@yield('modal')
	@yield('chart')
	@yield('tabs')-->
	@yield('content')
</article>



</body>
</html>
@yield('external-script')
