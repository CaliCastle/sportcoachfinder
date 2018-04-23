@extends('bases.auth')

@section('title', 'Reset Password')

@section('body.content')
    <div class="auth__panel__greeting">
        <h3>Forgot your password?<br>No worries, reset it through your email</h3>
    </div>
    <div class="auth__panel__form">
        <div class="auth__form">
            <div class="auth__form__input auth__form__input--email">
                <input type="email" placeholder="Email address" name="email" required>
            </div>
            <div class="auth__form__actions">
                <div class="auth__form__actions__button auth__form__actions__button--reset waves-button-light">
                    <i class="reset-icon"></i>
                    <span>Send reset email</span>
                </div>
            </div>
        </div>
        <div class="auth__disclaimer text-center">
            <p>Remembered your password? <a href="{{ route('login') }}" pjax>Sign in</a></p>
        </div>
    </div>
@stop