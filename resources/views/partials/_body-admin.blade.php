<body>
<main id="@yield('body.id', 'app')" class="@yield('body.class')">
	@yield('body')
</main>

<script src="{{ mix('/js/admin/manage.js') }}"></script>
@stack('body.scripts')

</body>