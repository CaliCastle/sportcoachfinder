@extends('bases.skeleton')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endpush

@section('body')
	@include('partials.navigation-bar.transparent')

	@yield('body.content')

	@include('partials.footer.curved')
@stop

@push('body.scripts')
	<script src="{{ mix('/js/app.js') }}"></script>
@endpush