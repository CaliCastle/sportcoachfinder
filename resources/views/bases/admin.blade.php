@extends('bases.skeleton-admin')

@push('head')
	<link rel="stylesheet" href="{{ mix('/css/admin/core.css') }}">
@endpush

@section('body')


	@yield('body.content')


@stop