@extends('bases.main_transparent')

@section('title', 'Home')

@section('body.content')
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
@stop