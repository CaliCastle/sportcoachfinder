@extends('bases.admin')

@section('title', $user === null ? 'Create a User' : 'Edit User')

@section('body.content')
	<div class="card">
		<div class="card__banner card__banner--avatar">
			<div class="avatar">
				<avatar :username="name" :size="100" src="{{ $user->avatarUrl ?? "" }}"></avatar>
			</div>
		</div>
		<div class="card__content">
			<div class="form-wrapper">
				<Loader></Loader>
				<form action="{{ url()->current() }}" method="{{ $user === null ? 'POST' : 'PUT' }}" class="form"
				      loadable>
					@component('admin.components.form-input', [
						'direction' => 'vertical',
						'required' => true
					])
						@slot('label')
							Full name
						@endslot

						@slot('name')
							name
						@endslot
					@endcomponent
					@component('admin.components.form-input', [
						'direction' => 'vertical',
						'required' => true,
						'type' => 'email'
					])
						@slot('label')
							Email
						@endslot

						@slot('name')
							email
						@endslot
					@endcomponent

					@if($user === null)
						<div class="form__input form__input--vertical"
						     v-bind:class="{ 'has-error': hasError('password') }">
							<label for="password" class="label" required>Password</label>
							<input type="password" class="text-input" v-model="password" id="password" required>
							<transition name="fadeInDown">
								<span v-if="hasError('password')"
								      class="form__input__message">@{{ errors.password[0] }}</span>
							</transition>
						</div>
					@endif
					<div class="form__input form__input--horizontal">
						<label for="gender" class="label">Gender</label>
						<select name="gender" id="gender" v-model="gender">
							<option value="none">None</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="trans">Trans</option>
						</select>
					</div>
					<div class="form__input form__input--horizontal">
						<label class="label">Verified</label>
						<toggle-button :value="{{ optional($user)->verified == true ? 'true' : 'false' }}"
						               :width="40"
						               :sync="true"/>
					</div>
					<div class="form__input form__input--horizontal">
						<label for="role" class="label">Role</label>
						<select name="role" class="long" id="role" v-model="role">
							@foreach(\SCF\Models\Role::all() as $role)
								<option value="{{ $role->name }}">{{ $role->readableName() }}</option>
							@endforeach
						</select>
					</div>
					@component('admin.components.form-submit')
						{{ $user === null ? 'Create' : 'Update' }}
					@endcomponent
				</form>
			</div>
		</div>
	</div>
@stop

@push('body.scripts')
	<script>
        var vm = new Vue({
            el: '#admin',
            data: {
                creating: {{ $user === null ? 'true' : 'false' }},
                name: '{{ optional($user)->name ?? '' }}',
                email: '{{ optional($user)->email ?? '' }}',
                gender: '{{ optional($user)->gender ?? 'none' }}',
                role: '{{ optional($user)->role->name ?? 'normal' }}',
				@if($user === null)
                password: '',
				@endif
                errors: {}
            },
            computed: {
                formData: function () {
                    return {
                        name: this.name,
                        email: this.email,
                        gender: this.gender,
                        role: this.role,
						@if($user === null)
                        password: this.password,
						@endif
                        verified: this.$children[2].toggled
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