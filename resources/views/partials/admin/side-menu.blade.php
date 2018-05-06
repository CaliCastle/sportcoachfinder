<nav class="side-menu" id="side-menu">
	<header class="side-menu__user">
		<input type="file" accept="image/*" style="display: none;" name="avatar" @change="avatarSelected($event)" data-url="{{ route('avatar') }}">
		<div class="avatar" @click.prevent="selectAvatar">
			<avatar username="{{ $myself->name }}" src="{{ $myself->avatarUrl ?? "" }}" :size="60"></avatar>
		</div>
		<strong>{{ $myself->name }}</strong>
		<span>{{ $myself->email }}</span>
	</header>
	<main>
		<a href="{{ route('admin.dashboard') }}" class="menu-link{{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? ' active' : ''}}">
			<i class="dashboard-icon"></i>
			<span>Dashboard</span>
		</a>
		<a href="{{ route('admin.users') }}" class="menu-link{{ str_contains(Route::currentRouteName(), 'admin.users') ? ' active' : ''}}">
			<i class="users-icon"></i>
			<span>Users</span>
		</a>
		<a href="{{ route('admin.reviews') }}" class="menu-link{{ str_contains(Route::currentRouteName(), 'admin.reviews') ? ' active' : ''}}">
			<i class="reviews-manage-icon"></i>
			<span>Reviews</span>
		</a>
		<a href="{{ route('admin.report') }}" class="menu-link{{ str_contains(Route::currentRouteName(), 'admin.report') ? ' active' : ''}}">
			<i class="report-icon"></i>
			<span>Report</span>
		</a>
		<a href="{{ route('admin.settings') }}" class="menu-link{{ str_contains(Route::currentRouteName(), 'admin.settings') ? ' active' : ''}}">
			<i class="website-icon"></i>
			<span>Settings</span>
		</a>
		<a href="{{ route('home') }}" class="menu-link">
			<i class="back-icon"></i>
			<span>Home</span>
		</a>
	</main>
</nav>