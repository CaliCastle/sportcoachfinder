@extends('bases.auth')

@section('title', request()->fullUrlIs(route('login')) ? 'Login' : 'Register')

@section('body.content')
	<div class="auth__panel__greeting">
		<h3>Welcome, let's get you signed in</h3>
	</div>
	<div class="auth__panel__form">
		<form class="auth__form login" loadable method="POST" action="{{ route('login') }}">
			<div class="auth__form__input auth__form__input--email" v-bind:class="{ 'has-error': hasError('email') }">
				<input type="email" placeholder="Email address" name="email" v-model="email" @focus="inputFocused" @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
				<span v-if="hasError('email')" class="auth__form__input__message">@{{ errors.email[0] }}</span>
			</div>
			<div class="auth__form__input auth__form__input--password">
				<input type="password" placeholder="Password" name="password" v-model="password" @focus="inputFocused" @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
			</div>
			<div class="auth__form__meta">
				<div class="auth__form__meta__remember" @click="rememberMe = !rememberMe">
					<div class="checkbox" v-bind:class="{ checked: rememberMe }"></div>
					<span>Remember me</span>
					<input type="hidden" name="remember" v-model="rememberMe">
				</div>
				<div class="auth__form__meta__forgot">
					<a href="{{ route('password.request') }}">Forgot password?</a>
				</div>
			</div>
			<div class="auth__form__actions">
				<div class="auth__form__actions__button auth__form__actions__button--signin waves-button-light" @click="login">
					<i class="login-icon"></i>
					<span>Sign in</span>
				</div>
				<div class="auth__form__actions__button auth__form__actions__button--signup waves-button-light">
					<i class="plus-icon"></i>
					<span>Sign up</span>
				</div>
			</div>
			<div class="auth__form__separator">
				<span>or</span>
			</div>
		</form>
		<div class="auth__social">
			<div class="auth__social__button auth__social__button--google waves-button-light">
				<i class="google"></i>
				<span>Login via Google</span>
			</div>
			<div class="auth__social__button auth__social__button--facebook waves-button-light">
				<i class="facebook"></i>
				<span>Login via Facebook</span>
			</div>
		</div>
		<div class="auth__disclaimer">
			<p>By signing up, you agree to our <br><a href="#">Terms and Conditions</a> & <a href="#">Privacy Policy</a></p>
		</div>
	</div>
@stop