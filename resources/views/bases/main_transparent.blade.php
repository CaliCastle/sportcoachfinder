@extends('bases.skeleton')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endpush

@section('body')
<nav class="ui-navigation-bar ui-navigation-bar--transparent">
	<div class="ui-navigation-bar__container">
		<div class="ui-navigation-bar__left">
			<a class="ui-navigation-bar__link" href="#">
				FAQ
			</a>
			<a class="ui-navigation-bar__link" href="#">
				About us
			</a>
		</div>
		<div class="ui-navigation-bar__right">
			<a class="ui-navigation-bar__link ui-navigation-bar__action primary-gradient shadowed" href="#">
				<i class="coach-icon"></i>&nbsp;Become a coach
			</a>
			<a class="ui-navigation-bar__link" href="#">
				Sign up / Sign in
			</a>
		</div>
	</div>
</nav>

<section class="hero">
	<div class="overlay--black"></div>

</section>
@stop

@push('body.scripts')
	<script src="/js/app.js"></script>
@endpush