@component('mail::message')
# Hi, {{ $user->name }}

You just created an account at our website, to confirm it's really you here is the confirmation code:

@component('mail::button')
{{ $code }}
@endcomponent

<p style="text-align:center;">
	<small>If you didn't create an account at our website, then you can ignore this email.</small>
</p>
@endcomponent
