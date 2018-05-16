@extends('bases.auth')

@php
	$registering = !request()->fullUrlIs(route('sign-in'));
@endphp

@push('head')
	<script xmlns:v-bind="http://www.w3.org/1999/xhtml">
        var registering = {{ $registering ? 'true' : 'false' }};
	</script>
@endpush

@section('title', $registering ? 'Sign In' : 'Sign Up')

@section('body.content')
	<div class="auth__panel__greeting">
		<h3 v-text="`Sign ${registering ? 'Up' : 'In'}`" v-if="!confirming && !enteringInfo"></h3>
		<h3 v-if="enteringInfo">Last step,<br>We'd like to know more about you</h3>
		<transition name="fadeInDown">
			<h3 v-if="confirming">Enter the code we just sent to your email</h3>
		</transition>
	</div>
	<div class="auth__panel__form">
		<Loader></Loader>
		<transition name="fadeInLeft" mode="out-in">
			<form action="{{ route('essential-info') }}" method="POST" loadable class="auth__form auth__form--info"
			      v-if="enteringInfo">
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--location auth__form__input--normalized"
					     v-bind:class="{ 'has-error': hasError('zipcode') }">
						<input type="tel" placeholder="Zip code" name="zipcode" v-model="essentialInfo.zipcode"
						       @focus="inputFocused"
						       @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
						<span v-if="hasError('zipcode')"
						      class="auth__form__input__message">@{{ errors.zipcode[0] }}</span>
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--mobile auth__form__input--normalized"
					     v-bind:class="{ 'has-error': hasError('mobile') }">
						<input type="tel" placeholder="Mobile phone" name="mobile" v-model="essentialInfo.mobile"
						       @focus="inputFocused"
						       @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
						<span v-if="hasError('mobile')"
						      class="auth__form__input__message">@{{ errors.mobile[0] }}</span>
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--large">
						<label for="sport">Sport</label>
						<input data-url="{{ route('get-sports') }}" type="text" name="sport" v-model="essentialInfo.sport" id="sport" placeholder="Enter sport name... (e.g. Soccer)">
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--large">
						<label for="birthday">Date of birth</label>
						<input type="text" name="birthday" v-model="essentialInfo.dateOfBirth" id="birthday">
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__select">
						<label for="gender">Gender</label>
						<select name="gender" id="gender" v-model="essentialInfo.gender" class="long">
							<option value="none">None</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="trans">Trans</option>
						</select>
					</div>
				</transition>
				<div class="auth__form__actions padding-v-mid">
					<div class="auth__form__actions__button auth__form__actions__button--signin waves-button-light"
					     @click="submitInfo">
						<i class="login-icon"></i>
						<span>Submit</span>
					</div>
				</div>
			</form>
			<form action="{{ route('confirmation') }}" method="POST" loadable class="auth__form auth__form--confirm"
			      v-if="confirming" resend-message="Confirmation has been re-sent to your email, check your mailbox!">
				<div class="confirmation-inputs">
					@for($i = 0; $i <= 5; $i++)
						<div class="confirmation-input">
							<input type="tel" maxlength="1" autocomplete="off" autocorrect="false" autofocus
							       autocapitalize="false" tabindex="" spellcheck="false" id="code-{{ $i }}"
							       @keyup="confirmCodeEntered" @keyup.delete="deleteConfirmCode"
							       v-model.number="confirmCodes[{{ $i }}]" placeholder="">
						</div>
					@endfor
				</div>
				<span v-if="hasError('code')" class="auth__form__input__message">@{{ errors.code[0] }}</span>
				<div class="padding-v-mid text-center">
					<button v-bind:class="{ 'disabled': resendingConfirmation }" @click.prevent="resendConfirmationCode"
					        class="resend">Resend the code
					</button>
				</div>
				<div class="auth__form__actions padding-v-mid">
					<div class="auth__form__actions__button auth__form__actions__button--signin waves-button-light"
					     v-bind:class="{'disabled': !validConfirmationCode}" @click="submitConfirmationCode">
						<i class="login-icon"></i>
						<span>Confirm</span>
					</div>
				</div>
			</form>
			<form class="auth__form" v-if="!confirming && !enteringInfo" loadable method="POST"
			      login-action="{{ route('sign-in') }}"
			      register-action="{{ route('sign-up') }}">
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--name"
					     v-bind:class="{ 'has-error': hasError('firstName') }" v-if="registering">
						<input type="text" placeholder="First name" name="firstName" v-model="firstName"
						       @focus="inputFocused"
						       @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
						<span v-if="hasError('firstName')"
						      class="auth__form__input__message">@{{ errors.firstName[0] }}</span>
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--name"
					     v-bind:class="{ 'has-error': hasError('lastName') }" v-if="registering">
						<input type="text" placeholder="Last name" name="lastName" v-model="lastName"
						       @focus="inputFocused"
						       @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
						<span v-if="hasError('lastName')"
						      class="auth__form__input__message">@{{ errors.lastName[0] }}</span>
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--email auth__form__input--normalized"
					     v-bind:class="{ 'has-error': hasError('email') }">
						<input type="email" placeholder="Email address" name="email" v-model="email"
						       @focus="inputFocused"
						       @blur="inputBlurred" @keyup.enter.prevent="submitForm" required autofocus>
						<span v-if="hasError('email')" class="auth__form__input__message">@{{ errors.email[0] }}</span>
					</div>
				</transition>
				<transition name="fadeInDown">
					<div class="auth__form__input auth__form__input--password"
					     v-bind:class="{ 'has-error': hasError('password') }">
						<input type="password" placeholder="Password" name="password" v-model="password"
						       @focus="inputFocused" @blur="inputBlurred" @keyup.enter.prevent="submitForm" required>
						<span v-if="hasError('password')"
						      class="auth__form__input__message">@{{ errors.password[0] }}</span>
					</div>
				</transition>
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
					<div class="auth__form__actions__button auth__form__actions__button--signin waves-button-light"
					     v-bind:class="{ 'can-submit': !registering }" @click="login">
						<i class="login-icon"></i>
						<span v-text="registering ? 'Sign in' : 'Login'"></span>
					</div>
					<div class="auth__form__actions__button auth__form__actions__button--signup waves-button-light"
					     v-bind:class="{ 'can-submit': registering }" @click="register">
						<i class="plus-icon"></i>
						<span v-text="registering ? 'Submit' : 'Sign up'"></span>
					</div>
				</div>
				<div class="auth__form__separator">
					<span>or</span>
				</div>
			</form>
		</transition>
		<transition name="fadeInLeft">
			<div class="auth__social" v-if="!confirming && !enteringInfo">
				<div class="auth__social__button auth__social__button--google waves-button-light">
					<i class="google"></i>
					<span>Login via Google</span>
				</div>
				<div class="auth__social__button auth__social__button--facebook waves-button-light">
					<i class="facebook"></i>
					<span>Login via Facebook</span>
				</div>
			</div>
		</transition>
		<transition name="fadeInUp" mode="out-in">
			<div class="auth__disclaimer" v-show="registering">
				<p>By signing up, you agree to our <br><a href="#">Terms and Conditions</a> & <a href="#">Privacy
						Policy</a></p>
			</div>
		</transition>
	</div>
@stop