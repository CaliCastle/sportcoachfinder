<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:type" content="website">
	<meta property="og:title" content="{{ config('app.name') }}">
	<meta property="og:description" content="{{ config('app.description') }}">
	{{--<meta property="og:image" content="/">--}}
	{{--<meta property="og:url" content="http://euro-travel-example.com/index.htm">--}}
	<meta name="twitter:card" content="summary_large_image">

	<title>@yield('title') | {{ config('app.name') }}</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Cabin:300,500,600,800" rel="stylesheet">
</head>