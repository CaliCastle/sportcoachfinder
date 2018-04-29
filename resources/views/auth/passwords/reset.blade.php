@extends('bases.auth')

@push('head')
    <script>
        var registering = false;
    </script>
@endpush

@section('title', 'Password Reset')

@section('body.content')
    <div class="auth__panel__greeting">
        <h3>Finish resetting your password</h3>
    </div>
    <div class="auth__panel__form">
        <Loader></Loader>
        <form class="auth__form" method="POST" action="{{ route('password.request') }}" loadable>
            <input type="hidden" class="hidden" hidden v-model="token" name="token">
            <transition name="fadeInDown">
                <div class="auth__form__input auth__form__input--email"
                     v-bind:class="{ 'has-error': hasError('email') }">
                    <input type="email" placeholder="Your email address" name="email" v-model="email" @focus="inputFocused"
                           @blur="inputBlurred" @keyup.enter.prevent="completePasswordReset" required autofocus>
                    <span v-if="hasError('email')" class="auth__form__input__message">@{{ errors.email[0] }}</span>
                </div>
            </transition>
            <transition name="fadeInDown">
                <div class="auth__form__input auth__form__input--password" v-bind:class="{'has-error': hasError('password')}">
                    <input type="password" placeholder="New password"
                           name="password" v-model="password" required @focus="inputFocused"
                           @blur="inputBlurred" @keyup.enter.prevent="completePasswordReset">
                    <span v-if="hasError('password')" class="auth__form__input__message">@{{ errors.password[0] }}</span>
                </div>
            </transition>
            <div class="auth__form__input auth__form__input--password">
                <input type="password" placeholder="Confirm password"
                       name="confirm_password" required v-model="passwordConfirmation" @focus="inputFocused"
                       @blur="inputBlurred" @keyup.enter.prevent="completePasswordReset">
            </div>
            <div class="auth__form__actions">
                <div class="auth__form__actions__button auth__form__actions__button--reset waves-button-light"
                     @click.prevent="completePasswordReset">
                    <i class="reset-icon"></i>
                    <span>Reset password</span>
                </div>
            </div>
        </form>
        <div class="auth__disclaimer text-center">
            <p>Remembered your password? <a href="{{ route('sign-in') }}">Sign in</a></p>
        </div>
    </div>
@stop

@push('body.scripts-bottom')
    <script>
        @if(isset($email))
            vm.email = '{{ $email }}';
        @endif
        vm.token = '{{ $token }}';
    </script>
@endpush