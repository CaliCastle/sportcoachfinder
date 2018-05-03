@extends('bases.admin')

@section('title', 'Users')

@section('body.content')
	<div class="table users-table" id="users">
		<header class="table-heading">
			<h2>Manage users</h2>
			<a href="#" class="create"><i class="plus-icon"></i></a>
		</header>
		<section class="table-content">
		@foreach($users as $user)
			<div class="row user-row" user-id="{{ $user->id }}">
				<div class="user-row__avatar">
					<img src="{{ $user->avatarUrl }}" alt="Avatar">
				</div>
				<div class="user-row__name">
					<strong>{{ $user->name }}</strong>
					<span>{{ $user->email }}</span>
				</div>
				<div class="user-row__status {{ $user->roleClass() }}"></div>
				@unless($user->id == $myself->id)
				<div class="row__actions">
					<a href="#" class="edit"><i class="edit-icon"></i></a>
					<a href="#" class="delete" @click.prevent="confirmDeleteUser"><i class="delete-icon"></i></a>
				</div>
				@endunless
			</div>
		@endforeach
		</section>
	</div>

@stop

@push('body.scripts')
	<script>
		var vm = new Vue({
			el: '#users',
			data: {
			    deleteUrl: '{{ route('admin.users') }}/'
			},
			methods: {
			    confirmDeleteUser: function (e) {
				    var el = e.target.closest('[user-id]');
					var userId = el.getAttribute('user-id');

					swal({
						text: 'Are you sure that you want to delete this user?',
						title: 'Deleting User',
						icon: 'warning',
                        buttons: true,
                        dangerMode: true
					}).then(function (willDelete) {
						if (!willDelete)
						    return;

                        return axios.delete(vm.deleteUrl + userId);
                    }).then(function (response) {
                        el.classList.add('fadeOut');
                        setTimeout(function () {
                            el.remove();
                        }, 300);

                        return;
                    }).catch(function (error) {
                        if (error) {
                            swal('Oh snap', 'Request failed', 'error');
                        }
                    });
                }
			}
		});
	</script>
@endpush