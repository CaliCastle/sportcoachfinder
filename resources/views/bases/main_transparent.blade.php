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
				<i class="coach-icon" style="font-size: 1.7rem;"></i>&nbsp;Become a coach
			</a>
			<a class="ui-navigation-bar__link" href="#">
				Sign up / Sign in
			</a>
		</div>
	</div>
</nav>

<section class="hero">
	<div class="overlay overlay--black"></div>
	<div class="hero__background"></div>
	<div class="hero__content">
		<div class="hero__content__logo">
			<span class="logo--text">Sport Coach Finder</span>
			<img src="/assets/images/logo-white.png" alt="Logo">
		</div>
		<div class="hero__content__search-container">
			<div class="search-box search-box--sport shadowed">
				<input type="text" placeholder="Enter sport name">
			</div>
			<div class="search-box search-box--location shadowed">
				<input type="text" placeholder="Enter location">
			</div>
			<button class="search-button primary-gradient--reverse shadowed">
				<span>Search</span>
			</button>
		</div>
		<div class="hero__content__tips">
			<p>The online directory of personal sport coaches and mentors</p>
		</div>
	</div>
</section>
<footer class="ui-footer">
	<svg class="ui-footer__curve" viewBox="0 0 1440 97" preserveAspectRatio="none">
		<g id="footer-curve">
			<path d="M0,0 C143.702507,88.7542517 333.547888,114.816217 569.536145,78.1858968 C805.524401,41.5555762 1095.67902,15.4936106 1440,0 L1440,96.0569821 L0,96.0569821 L0,0 Z"></path>
		</g>
	</svg>
	<div class="ui-footer__main">
		<div class="ui-footer__connect">
			<a href="#" class="ui-footer__logo">
				<img src="/assets/images/logo-white.png" alt="Logo">
			</a>
			<span>Connect with us</span>
			<div class="ui-footer__socials">
				<a class="ui-footer__social instagram" href="#"></a>
				<a class="ui-footer__social twitter" href="#"></a>
				<a class="ui-footer__social facebook" href="#"></a>
			</div>
		</div>
		<div class="ui-footer__related">
			<div class="ui-footer__links">
				{{--<h3 class="ui-footer__links__heading">Resources</h3>--}}
			</div>
		</div>
		<div class="ui-footer__international"></div>
	</div>
	<div class="ui-footer__separator"></div>
	<div class="ui-footer__coaches-counter"></div>
	<div class="ui-footer__copyright">
		<span>Copyright &copy; {{ date('Y') }} - {{ config('app.name') }}. All rights reserved.</span>
	</div>
</footer>
@stop

@push('body.scripts')
	<script src="/js/app.js"></script>
@endpush