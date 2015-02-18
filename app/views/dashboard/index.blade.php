@extends('template/template')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif
@stop