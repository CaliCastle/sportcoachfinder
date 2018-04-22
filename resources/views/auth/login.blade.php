@extends('bases.auth')

@section('title', request()->fullUrlIs(route('login')) ? 'Login' : 'Register')

@section('body.content')
	<div class="auth__container auth__container--main">
		<nav class="auth__nav">
			<a href="{{ route('home') }}"><i class="back-icon"></i>&nbsp; Home</a>
			<div class="auth__language-selector">
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
				<div class="auth__panel__greeting">
					<h3>Welcome, let's get you signed in</h3>
				</div>
				<div class="auth__panel__form">
					<div class="auth__form">
						@csrf
						<div class="auth__form__input auth__form__input--email">
							<input type="email" placeholder="Email address" name="email" required>
						</div>
						<div class="auth__form__input auth__form__input--password">
							<input type="password" placeholder="Password" name="password" required>
						</div>
						<div class="auth__form__meta">
							<div class="auth__form__meta__remember">
								<div class="checkbox checked"></div>
								<span>Remember me</span>
								<input type="hidden" name="remember">
							</div>
							<div class="auth__form__meta__forgot">
								<a href="{{ route('password.request') }}">Forgot password?</a>
							</div>
						</div>
						<div class="auth__form__actions">
							<div class="auth__form__actions__button auth__form__actions__button--signin">
								<i class="login-icon"></i>
								<span>Sign in</span>
							</div>
							<div class="auth__form__actions__button auth__form__actions__button--signup">
								<i class="plus-icon"></i>
								<span>Sign up</span>
							</div>
						</div>
						<div class="auth__form__separator">
							<span>or</span>
						</div>
					</div>
					<div class="auth__social">
						<div class="auth__social__button auth__social__button--google">
							<i class="google"></i>
							<span>Login via Google</span>
						</div>
						<div class="auth__social__button auth__social__button--facebook">
							<i class="facebook"></i>
							<span>Login via Facebook</span>
						</div>
					</div>
					<div class="auth__disclaimer">
						<p>By signing up, you agree to our <br><a href="#">Terms and Conditions</a> & <a href="#">Privacy Policy</a></p>
					</div>
				</div>
			</div>
		</div>
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
			<div class="auth__background__overlay"></div>
			<div class="auth__background__cover"></div>
		</div>
	</aside>
@stop