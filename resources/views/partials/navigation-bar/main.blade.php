<nav class="ui-navigation-bar ui-navigation-bar--main">
	<div class="ui-navigation-bar__container">
		<div class="ui-navigation-bar__left">
			<a class="ui-navigation-bar__link" href="{{ route('home') }}">
				<img src="/assets/images/logo-white.png" alt="Logo" class="nav-logo">
			</a>
		</div>
		<div class="ui-navigation-bar__right">
			@guest
				<a class="ui-navigation-bar__link ui-navigation-bar__action"
				   href="{{ route('apply') }}">
					<i class="coach-icon" style="font-size: 1.7rem;"></i>&nbsp;Become a coach
				</a>
				<a class="ui-navigation-bar__link" href="{{ route('login') }}">
					Sign up / Sign in
				</a>
			@else
				<a href="#"></a>
			@endguest
		</div>
	</div>
</nav>