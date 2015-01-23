@extends('template/template')

@section('content')
	<h3 class="text-primary">{{$titulo}}</h3>
  @include('partials/reportes/filtros')
@stop