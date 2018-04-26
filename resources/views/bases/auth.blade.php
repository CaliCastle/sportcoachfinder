@extends('bases.skeleton')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/auth.css') }}">
@endpush

@section('body.class', 'auth')

@section('body')

	<div class="auth__container auth__container--main">
		<nav class="auth__nav">
			<a href="{{ route('home') }}" class="rounded waves-button-light"><i class="back-icon"></i>&nbsp; Home</a>
			<div class="auth__language-selector waves-button-light">
				<svg viewBox="0 0 48 48">
					<use xlink:href="#globe"></use>
				</svg>
				<span>English (US)</span>
			</div>
		</nav>
		<div class="auth__panel-container">
			<div class="auth__panel">
				<div class="auth__panel__logo">
					<span>{{ config('app.name') }}</span>
					<img class="logo" src="/assets/images/logo-green.png" alt="Logo">
				</div>

				@yield('body.content')

			</div>
		</div>
	</div>
	<aside class="auth__container auth__container--side">
		<nav class="auth__nav">
			<a href="#" class="rounded waves-button-light">FAQs</a>
			<a href="#" class="rounded waves-button-light">Contact</a>
			<a href="#" class="rounded waves-button-light">About</a>
			<a href="#" class="rounded waves-button-light">Support</a>
		</nav>
		<div class="auth__background">
			<div class="auth__background__image"></div>
			<div class="auth__background__overlay"></div>
			<div class="auth__background__cover"></div>
			{{--<div class="auth__background__features">--}}
				{{--<ul>--}}
					{{--<li>--}}
						{{--View and review local sport coaches in your area--}}
					{{--</li>--}}
					{{--<li>--}}
						{{--Access to coaches from a variety of backgrounds and areas of expertise--}}
					{{--</li>--}}
					{{--<li>--}}
						{{--Background certified coaches--}}
					{{--</li>--}}
				{{--</ul>--}}
			{{--</div>--}}
		</div>
	</aside>

@stop

@push('body.scripts')
	<script src="{{ mix('/js/auth.js') }}"></script>
@endpush