@extends('bases.admin')

@section('title', 'Users')

@section('body.content')
	<div class="table users-table">
		<header class="table-heading">
			<h2>Manage users</h2>
			<a href="#" class="create"><i class="plus-icon"></i></a>
		</header>
		<section class="table-content">
		@foreach($users as $user)
			<div class="row user-row">
				<div class="user-row__avatar">
					<img src="{{ $user->avatarUrl }}" alt="Avatar">
				</div>
				<div class="user-row__name">
					<strong>{{ $user->name }}</strong>
					<span>{{ $user->email }}</span>
				</div>
				<div class="user-row__status {{ $user->roleClass() }}"></div>
				<div class="row__actions">
					<a href="#" class="edit"><i class="edit-icon"></i></a>
					<a href="#" class="delete"><i class="delete-icon"></i></a>
				</div>
			</div>
		@endforeach
		</section>
	</div>

@stop