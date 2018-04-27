<nav class="ui-navigation-bar ui-navigation-bar--main">
	<div class="ui-navigation-bar__container">
		<div class="ui-navigation-bar__left">
			<a class="ui-navigation-bar__link waves-button-light" href="{{ route('home') }}">
				<img src="/assets/images/logo-white.png" alt="Logo" class="nav-logo">
			</a>
			<div class="ui-navigation-bar__search">
				<input type="search" name="query" placeholder="Search sports">
			</div>
			<a class="ui-navigation-bar__link ui-navigation-bar__link--dropdown ui-navigation-bar__link--no-padding" href="#">
				<i class="location-icon"></i>
			</a>
			<a class="ui-navigation-bar__link ui-navigation-bar__link--dropdown ui-navigation-bar__link--no-padding" href="#">
				<svg viewBox="0 0 48 48">
					<use xlink:href="#globe"></use>
				</svg>
			</a>
		</div>
		<div class="ui-navigation-bar__right">
			@guest
				<a class="ui-navigation-bar__link ui-navigation-bar__action waves-button-light"
				   href="{{ route('apply') }}">
					<i class="coach-icon" style="font-size: 1.7rem;"></i>&nbsp;Become a coach
				</a>
				<a class="ui-navigation-bar__link waves-button-light" href="{{ route('sign-in') }}">
					Sign up / Sign in
				</a>
			@else
				@if(auth()->user()->hasRole('normal'))
					<a class="ui-navigation-bar__link ui-navigation-bar__action primary-gradient--dimmed waves-button-light"
					   href="{{ route('apply') }}">
						<i class="coach-icon" style="font-size: 1.7rem;"></i>&nbsp;Become a coach
					</a>
				@endif
				<div class="ui-navigation-bar__user">
					<div class="ui-navigation-bar__avatar">
						<img src="{{ auth()->user()->getGravatarUrl() }}" alt="Avatar">
					</div>
					<form action="{{ route('logout') }}" method="POST">
						@csrf
						<button type="submit" class="ui-navigation-bar__link waves-button-light">Log out</button>
					</form>
				</div>
			@endguest
		</div>
	</div>
</nav>