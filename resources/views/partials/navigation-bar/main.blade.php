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
		</div>
		@include('partials.navigation-bar.partials.right')
	</div>
</nav>