@extends('bases.admin')

@section('title', isset($keyword) ? "Searching '" . $keyword . "'" : 'Users')

@section('body.content')
	<div id="users">
		<div class="search-panel">
			<div class="search-wrapper">
				<form method="GET" action="{{ route('admin.users.search') }}" class="search">
					<input type="search" class="search-input" placeholder="Search users..." name="q">
					<i class="search-icon" @click="$event.target.closest('form').submit()"></i>
				</form>
			</div>
		</div>
		<div class="table users-table">
			<header class="table-heading">
				<h2>{{ $users->total() }} Users</h2>
				<a href="{{ route('admin.users.new') }}" class="create"><i class="plus-icon"></i></a>
			</header>
			<section class="table-content">
				@foreach($users as $user)
					<div class="row user-row" user-id="{{ $user->id }}">
						<div class="user-row__avatar">
							<avatar username="{{ $user->name }}" src="{{ $user->avatarUrl ?? "" }}" :size="45"></avatar>
						</div>
						<div class="user-row__name">
							<strong>{{ $user->name }}</strong>
							<span>{{ $user->email }}</span>
						</div>
						<div class="user-row__status {{ $user->roleClass() }}"></div>
						<div class="row__actions">
							<a href="{{ route('admin.users.edit', compact('user')) }}" class="edit">Edit</a>
							@unless($user->id == $myself->id)
								<a href="#" class="delete" @click.prevent="confirmDeleteUser">Delete</a>
							@endunless
						</div>
					</div>
				@endforeach
			</section>
			<footer class="table-pagination">
				{!! $users->links() !!}
			</footer>
		</div>
	</div>
@stop

@push('body.scripts')
	<script>
		@isset($keyword)
			var mark = new Mark(document.querySelector('.table-content'));
			mark.mark("{{ $keyword }}", {
			    "element": "span"
			})
		@endisset

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
                        if (response) {
                            el.classList.add('fadeOut');
                            setTimeout(function () {
                                el.remove();
                            }, 300);
                        }

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