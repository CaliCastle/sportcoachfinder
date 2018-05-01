<nav class="side-menu">
	<header class="side-menu__user">
		<div class="avatar">
			<img src="{{ $myself->avatarUrl }}" alt="Avatar">
		</div>
		<strong>{{ $myself->name }}</strong>
		<span>{{ $myself->email }}</span>
	</header>
	<main>
		<a href="{{ route('admin.dashboard') }}" class="menu-link{{ Route::currentRouteName() == 'admin.dashboard' ? ' active' : ''}}">
			<i class="dashboard-icon"></i>
			<span>Dashboard</span>
		</a>
		<a href="{{ route('admin.users') }}" class="menu-link{{ Route::currentRouteName() == 'admin.users' ? ' active' : ''}}">
			<i class="users-icon"></i>
			<span>Users</span>
		</a>
		<a href="{{ route('admin.reviews') }}" class="menu-link{{ Route::currentRouteName() == 'admin.reviews' ? ' active' : ''}}">
			<i class="reviews-manage-icon"></i>
			<span>Reviews</span>
		</a>
		<a href="{{ route('admin.report') }}" class="menu-link{{ Route::currentRouteName() == 'admin.report' ? ' active' : ''}}">
			<i class="report-icon"></i>
			<span>Report</span>
		</a>
		<a href="{{ route('admin.settings') }}" class="menu-link{{ Route::currentRouteName() == 'admin.settings' ? ' active' : ''}}">
			<i class="website-icon"></i>
			<span>Settings</span>
		</a>
	</main>
</nav>