@extends('bases.auth')

@push('head')
	<script>
        var registering = false;
	</script>
@endpush

@section('title', 'Reset Password')

@section('body.content')
	<div class="auth__panel__greeting">
		<h3>Forgot your password?<br>No worries, reset it through your email</h3>
	</div>
	<div class="auth__panel__form">
		<Loader></Loader>
		<form class="auth__form" method="POST" action="{{ route('password.email') }}" loadable>
			<transition name="fadeInDown">
			<div class="auth__form__input auth__form__input--email" v-bind:class="{'has-error': hasError('email')}">
				<input type="email" placeholder="Email address"
				       name="email" v-model="email" required @focus="inputFocused"
				       @blur="inputBlurred" @keyup.enter.prevent="passwordReset">
				<span v-if="hasError('email')" class="auth__form__input__message">@{{ errors.email[0] }}</span>
			</div>
			</transition>
			<div class="auth__form__actions">
				<div class="auth__form__actions__button auth__form__actions__button--reset waves-button-light"
				     @click.prevent="passwordReset">
					<i class="reset-icon"></i>
					<span>Send reset email</span>
				</div>
			</div>
		</form>
		<div class="auth__disclaimer text-center">
			<p>Remembered your password? <a href="{{ route('sign-in') }}">Sign in</a></p>
		</div>
	</div>
@stop