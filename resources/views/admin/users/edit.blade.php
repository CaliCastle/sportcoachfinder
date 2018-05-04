@extends('bases.admin')

@section('title', $user === null ? 'Create a User' : 'Edit User')

@section('body.content')
	<div class="card">
		<div class="card__banner--avatar">
			<div class="avatar">
				<img src="{{ optional($user)->avatarUrl ?? \SCF\Models\UserAvatar::defaultUrl() }}" alt="Avatar">
			</div>
		</div>
		<div class="card__content">
			<div class="form-wrapper">
				<Loader></Loader>
				<form action="{{ url()->current() }}" method="{{ $user === null ? 'POST' : 'PUT' }}" class="form" loadable>
					<div class="form__input form__input--vertical" v-bind:class="{ 'has-error': hasError('name') }">
						<label for="name" class="label" required>Full name</label>
						<input type="text" class="text-input" v-model="name" id="name" required>
						<transition name="fadeInDown">
							<span v-if="hasError('name')" class="form__input__message">@{{ errors.name[0] }}</span>
						</transition>
					</div>
					<div class="form__input form__input--vertical" v-bind:class="{ 'has-error': hasError('email') }">
						<label for="email" class="label" required>Email</label>
						<input type="email" class="text-input" v-model="email" id="email" required>
						<transition name="fadeInDown">
							<span v-if="hasError('email')" class="form__input__message">@{{ errors.email[0] }}</span>
						</transition>
					</div>
					<div class="form__input form__input--horizontal">
						<label for="gender" class="label">Gender</label>
						<select name="gender" id="gender" v-model="gender">
							<option value="none">None</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
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
					<div class="form__submit-wrapper">
						<button class="form__submit waves-button-light" @click.prevent="submit">
							{{ $user === null ? 'Create' : 'Update' }}
						</button>
					</div>
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
		        errors: []
	        },
	        computed: {
                formData: function () {
                    return {
                        name: this.name,
	                    email: this.email,
	                    gender: this.gender,
	                    role: this.role,
	                    // verified: this.
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