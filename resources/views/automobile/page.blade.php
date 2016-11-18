@extends('layouts.home')
@section('title','Motorpool Travel Services')
@section('header')
	@yield('header')
@endsection	
@section('content')
	@yield('modal')
	@yield('status')
	@yield('tabs')
	@yield('dropdown-section')
@endsection
@section('external-script')
	@yield('script')
	@yield('status-script')
@endsection