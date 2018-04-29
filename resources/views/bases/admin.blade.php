@extends('bases.skeleton-admin')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/admin/core.css') }}">
@endpush

@section('body.id', 'admin')

@section('body')

	<nav class="side-menu">
		<header class="side-menu__user">
			<div class="avatar">
				<img src="{{ $user->avatarUrl }}" alt="Avatar">
			</div>
			<strong>{{ $user->name }}</strong>
			<span>{{ $user->email }}</span>
		</header>
		<main>
			<a href="{{ route('admin.dashboard') }}" class="menu-link active">
				<i class="dashboard-icon"></i>
				<span>Dashboard</span>
			</a>
			<a href="{{ route('admin.dashboard') }}" class="menu-link">
				<i class="users-icon"></i>
				<span>Users</span>
			</a>
			<a href="{{ route('admin.dashboard') }}" class="menu-link">
				<i class="server-icon"></i>
				<span>Settings</span>
			</a>
		</main>
	</nav>
	<section class="admin-panel">
		@yield('body.content')
	</section>


@stop