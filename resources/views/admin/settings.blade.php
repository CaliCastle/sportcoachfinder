@extends('bases.admin')

@section('title', 'Settings')

@section('body.content')
	<div class="cards-2">
		<div class="card">
			<div class="card__banner card__banner--heading">
				<span>Basic Settings</span>
			</div>
			<div class="card__content">
				<div class="form-wrapper">
					<Loader></Loader>
					<form action="{{ route('admin.settings.basic') }}" class="form" method="PUT" id="basic" loadable>
						@component('admin.components.form-input', [
							'direction' => 'vertical',
							'required' => true
						])
							@slot('label')
								Title
							@endslot

							@slot('name')
								title
							@endslot
						@endcomponent

						@component('admin.components.form-input', [
							'direction' => 'vertical',
							'required' => true,
							'inputType' => 'textarea'
						])
							@slot('label')
								Description
							@endslot

							@slot('name')
								description
							@endslot
						@endcomponent

						@component('admin.components.form-input', [
							'direction' => 'vertical',
							'required' => true
						])
							@slot('label')
								Keywords (separate by comma ',')
							@endslot

							@slot('name')
								keywords
							@endslot
						@endcomponent
							@component('admin.components.form-submit')
								Update
							@endcomponent
					</form>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card__banner card__banner--heading">
				<span>SMTP Email Settings</span>
			</div>
			<div class="card__content">
				<div class="form-wrapper">
					<Loader></Loader>
					<form action="{{ route('admin.settings.smtp') }}" class="form" method="PUT" id="smtp" loadable>
						@component('admin.components.form-input', [
							'direction' => 'horizontal',
							'required' => true
						])
							@slot('label')
								Host
							@endslot

							@slot('name')
								host
							@endslot
						@endcomponent
						@component('admin.components.form-input', [
							'direction' => 'horizontal',
							'required' => true,
							'type' => 'tel'
						])
							@slot('label')
								Port
							@endslot

							@slot('name')
								port
							@endslot
						@endcomponent
						@component('admin.components.form-input', [
							'direction' => 'horizontal',
							'required' => true
						])
							@slot('label')
								Username
							@endslot

							@slot('name')
								username
							@endslot
						@endcomponent
						@component('admin.components.form-input', [
							'direction' => 'horizontal',
							'required' => true,
							'type' => 'password'
						])
							@slot('label')
								Password
							@endslot

							@slot('name')
								password
							@endslot
						@endcomponent
						@component('admin.components.form-submit')
							Update
						@endcomponent
					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@push('body.scripts')
	<script>
        var basic = new Vue({
            el: '#basic',
            data: {
                title: '{{ site('siteTitle') }}',
                description: '{{ site('description') }}',
                keywords: '{{ site('keywords') }}',
                errors: {}
            },
            computed: {
                formData: function () {
                    return {
                        siteTitle: this.title,
	                    description: this.description,
	                    keywords: this.keywords
                    }
                }
            },
            methods: {
                hasError: function (name) {
                    return this.errors.hasOwnProperty(name)
                },
                submit: function (e) {
                    var form = e.target.closest('.form');

                    submitForm(this, form);
                }
            }
        });

        var smtp = new Vue({
            el: '#smtp',
            data: {
                host: '{{ config('mail.host') }}',
                port: '{{ config('mail.port') }}',
                username: '{{ config('mail.username') }}',
                password: '{{ config('mail.password') }}',
                errors: {}
            },
            computed: {
                formData: function () {
                    return {
                        adminEmailHost: this.host,
	                    adminEmailPort: this.port,
	                    adminEmailUsername: this.username,
	                    adminEmailPassword: this.password
                    }
                }
            },
            methods: {
                hasError: function (name) {
                    return this.errors.hasOwnProperty(name)
                },
                submit: function (e) {
                    var form = e.target.closest('.form');

                    submitForm(this, form);
                }
            }
        });
	</script>
@endpush