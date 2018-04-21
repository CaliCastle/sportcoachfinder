@extends('bases.auth')

@section('title', request()->fullUrlIs(route('login')) ? 'Login' : 'Register')

@section('body.content')
	<div class="auth__container auth__container--main">
		<nav class="auth__nav">
			<a href="{{ route('home') }}"><i class="back-icon"></i>&nbsp; Home</a>
		</nav>
	</div>
	<aside class="auth__container auth__container--side">
		<nav class="auth__nav">
			<a href="#">FAQs</a>
			<a href="#">Contact</a>
			<a href="#">About</a>
			<a href="#">Support</a>
		</nav>
		<div class="auth__background">
			<div class="auth__background__image"></div>
			<div class="auth__background__cover"></div>
		</div>
	</aside>
@stop