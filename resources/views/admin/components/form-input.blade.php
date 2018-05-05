<div class="form__input form__input--{{ $direction }}" v-bind:class="{ 'has-error': hasError('{{ $name }}') }">
	<label class="label" for="{{ $name }}" {{ isset($required) && $required ? 'required' : '' }}>{{ $label }}</label>
	@isset($inputType)
		@include("admin.components.partials.$inputType")
	@else
		@include('admin.components.partials.input')
	@endisset

	<transition name="fadeInDown">
		<span v-if="hasError('{{ $name }}')" class="form__input__message" v-text="errors.{{ $name }}[0]"></span>
	</transition>

	{{ $slot }}
</div>