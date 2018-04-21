@extends('bases.skeleton')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/auth.css') }}">
@endpush

@section('body.class', 'auth')

@section('body')

	@yield('body.content')

@stop

@push('body.scripts')
	<script src="{{ mix('/js/auth.js') }}"></script>
@endpush