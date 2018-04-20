@extends('bases.skeleton')

@push('head')
@endpush

@section('body')

	@yield('body.content')

@stop

@push('body.scripts')
	<script src="/js/auth.js"></script>
@endpush