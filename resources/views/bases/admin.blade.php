@extends('bases.skeleton-admin')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/admin/core.css') }}">
@endpush

@section('body.id', 'admin')

@section('body')

	@include('partials.admin.side-menu')

	<section class="admin-panel">
		<header class="admin-panel__header">
			<div class="admin-panel__header__title">
				<i class="@yield('title')"></i>
				<h1>@yield('title')</h1>
			</div>
		</header>

		<div class="admin-panel__content">
			@yield('body.content')
		</div>

		<footer class="admin-panel__footer">
			<span class="copyright">
				&copy; {{ date('Y') }} {{ site('site_title') }}
			</span>
			<span class="developer">
				Developed & Designed by <strong>Cali Castle</strong>
			</span>
		</footer>
	</section>


@stop