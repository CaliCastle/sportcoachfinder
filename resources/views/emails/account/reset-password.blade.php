@component('mail::message')
# Hi, {{ $user->name }}

You are receiving this email because we received a password reset request for your account.

Click the button below to complete resetting your password:

@component('mail::button', ['url' => route('password.reset', ['token' => $token, 'email' => $user->email]), 'color' => 'red'])
Reset password
@endcomponent

If you did not request a password reset, no further action is required.

@endcomponent
