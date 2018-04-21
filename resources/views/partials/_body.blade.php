<body>
	<main id="@yield('body.id', 'app')" class="@yield('body.class')">
		@yield('body')
	</main>

	@stack('body.scripts')
</body>