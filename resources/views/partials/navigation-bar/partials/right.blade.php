<div class="ui-navigation-bar__right">
	@guest
		<a class="ui-navigation-bar__link ui-navigation-bar__action primary-gradient--dimmed waves-button-light"
		   href="{{ route('apply') }}">
			<i class="coach-icon" style="font-size: 1.7rem;"></i>&nbsp;Become a coach
		</a>
		<a class="ui-navigation-bar__link waves-button-light" href="{{ route('sign-in') }}">
			Sign up / Sign in
		</a>
	@else
		@php
			$user = Auth::user();
		@endphp

		@if(auth()->user()->hasRole('normal'))
			<a class="ui-navigation-bar__link ui-navigation-bar__action primary-gradient--dimmed waves-button-light"
			   href="{{ route('apply') }}">
				<i class="coach-icon" style="font-size: 1.7rem;"></i>&nbsp;Become a coach
			</a>
		@endif
		<div class="ui-navigation-bar__user">
			<div class="ui-navigation-bar__user__avatar waves-button-light" @click="toggleUserProfileDropdown">
				<img src="{{ $user->avatarUrl }}" alt="Avatar">
			</div>
			<div class="ui-navigation-bar__user__name" @click="toggleUserProfileDropdown">
				<span>{{ $user->name }}</span>
			</div>
			<div class="ui-navigation-bar__user__caret" @click="toggleUserProfileDropdown"></div>
			<div class="ui-navigation-bar__user__dropdown">
				<header>
					<form action="{{ route('logout') }}" method="POST" class="logout">
						@csrf
						<button type="submit" class="waves-button-light">
							<i class="shutdown-icon"></i>
							<span>Log out</span>
						</button>
					</form>
					<div class="user-info">
						<div class="avatar">
							<img src="{{ $user->avatarUrl }}" alt="Avatar">
						</div>
						<strong>{{ $user->name }}</strong>
						<span>{{ $user->email }}</span>
						@if($user->verified)
							<em class="{{ $user->roleClass() }}">
								{{ $user->readableRole() }}
							</em>
						@else
							<em class="{{ $user->roleClass() }} waves-button-light">
								Verify your email
							</em>
						@endif
					</div>
				</header>
				<main>
					@if($user->hasRole('admin'))
					<a href="{{ route('admin.dashboard') }}" class="dropdown-link waves-button-light">
						<i class="dashboard-icon"></i>
						<span>Manage website</span>
					</a>
					@endif
					<a href="#" class="dropdown-link waves-button-light">
						<i class="profile-icon"></i>
						<span>Edit profile</span>
					</a>
					<a href="#" class="dropdown-link waves-button-light">
						<i class="reviews-icon"></i>
						<span>My reviews</span>
					</a>
					<a href="#" class="dropdown-link waves-button-light">
						<i class="settings-icon"></i>
						<span>Preferences</span>
					</a>
				</main>
				<footer>
					<a href="#" class="block-button">
						<i class="help-icon"></i>
						<span>Help</span>
					</a>
					<a href="#" class="block-button">
						<i class="support-icon"></i>
						<span>Contact</span>
					</a>
				</footer>
			</div>
		</div>
	@endguest
</div>