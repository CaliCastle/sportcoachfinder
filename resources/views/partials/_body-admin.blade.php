<body>
<main id="@yield('body.id', 'app')" class="@yield('body.class')">
	@yield('body')
</main>

<script src="{{ mix('/js/plugins/core.js') }}"></script>
<script src="{{ mix('/js/core.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{ mix('/js/admin/manage.js') }}"></script>
@stack('body.scripts')

</body>