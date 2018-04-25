<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta property="og:type" content="website">
	<meta property="og:title" content="{{ config('app.name') }}">
	<meta property="og:description" content="{{ config('app.description') }}">
	{{--<meta property="og:image" content="/">--}}
	<meta property="og:url" content="{{ config('app.url') }}">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="base-url" content="{{ url('/') }}">

	<title>@yield('title') | {{ config('app.name') }}</title>

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#4cab52">
	<meta name="msapplication-TileColor" content="#4cab52">
	<meta name="theme-color" content="#4cab52">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link rel="prerender" href="{{ config('app.url') }}">

	<script src="/js/plugins/pace.min.js"></script>
	<script>
		var baseUrl = document.head.querySelector('meta[name=base-url]').content;
	</script>

	@stack('head')
</head>