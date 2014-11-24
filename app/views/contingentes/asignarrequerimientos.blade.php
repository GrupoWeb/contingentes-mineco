@extends('template/template')

@section('content')
<ol class="breadcrumb">
	  <li><a href="/contingentes">Contingentes</a></li>
	  <li>Asignar Requerimientos</li>
	  <li class="active">{{$productoN->nombre}}</li>
</ol>

@if(Session::get('message'))
<div class="alert alert-{{ Session::get('type') }} alert-dismissable .mrgn-top">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{{ Session::get('message') }}
</div>
@endif

	{{ Form::open(array('route' => 'contingente.requerimientos.store')) }}
	{{ Form::hidden('productoid', Crypt::encrypt($productoN->productoid)) }}
			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Inscripción</h3>
				  </div>
				  <div class="panel-body">
				  		<div class="pull-right">
				  		<a href="javascript:void(0);" id="tod{{$productoN->productoid}}" class="lnkTodosI">Todos</a> | 
				  		<a href="javascript:void(0);" id="nin{{$productoN->productoid}}" class="lnkNingunoI">Ninguno</a>
				  	</div>
					@foreach($requerimientos as $requerimiento)
						<div>
							<label>
								<input type="checkbox" value="{{$productoN->productoid}}-{{$requerimiento->requerimientoid}}"  name='reqInscripcion[]' id="mp{{$productoN->productoid.'-'.$requerimiento->requerimientoid}}" class="chkIn{{$productoN->productoid}}" 
								{{ (in_array($requerimiento->requerimientoid, $aInscripcion)) ? 'checked="true"' : '' }}> {{$requerimiento->nombre}}
							</label>
						</div>
					@endforeach
				  </div>
				</div>
			</div>	
			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Asignación</h3>
				  </div>
				  <div class="panel-body">
				  		<div class="pull-right">
				  		<a href="javascript:void(0);" id="tod{{$productoN->productoid}}" class="lnkTodosA">Todos</a> | 
				  		<a href="javascript:void(0);" id="nin{{$productoN->productoid}}" class="lnkNingunoA">Ninguno</a>
				  	</div>
					@foreach($requerimientos as $requerimiento)
						<div>
							<label>
								<input type="checkbox" value="{{$productoN->productoid}}-{{$requerimiento->requerimientoid}}"  name='reqAsignacion[]' id="mp{{$productoN->productoid.'-'.$requerimiento->requerimientoid}}" class="chkAsig{{$productoN->productoid}}" v
								{{ (in_array($requerimiento->requerimientoid, $aAsignacion)) ? 'checked="true"' : '' }}> {{$requerimiento->nombre}}
							</label>
						</div>
					@endforeach
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Emisión</h3>
				  </div>
				  <div class="panel-body">
				  		<div class="pull-right">
				  		<a href="javascript:void(0);" id="tod{{$productoN->productoid}}" class="lnkTodosE">Todos</a> | 
				  		<a href="javascript:void(0);" id="nin{{$productoN->productoid}}" class="lnkNingunoE">Ninguno</a>
				  	</div>
					@foreach($requerimientos as $requerimiento)
						<div>
							<label>
								<input type="checkbox" value="{{$productoN->productoid}}-{{$requerimiento->requerimientoid}}"  name='reqEmision[]' id="mp{{$productoN->productoid.'-'.$requerimiento->requerimientoid}}" class="chkEmi{{$productoN->productoid}}" v
								{{ (in_array($requerimiento->requerimientoid, $aEmision)) ? 'checked="true"' : '' }}> {{$requerimiento->nombre}}
							</label>
						</div>
					@endforeach
				  </div>
				</div>
			</div>
		<div class="col-md-12">{{Form::submit('Guardar', array('class' => 'btn btn-primary'))}}</div>
	{{ Form::close() }}
	<script>
		$(document).ready(function(){
			// Asignación
			$('.lnkTodosA').click(function(){
				id = $(this).attr('id').substr(3);
				$('.chkAsig' + id).prop('checked',true);
			});

			$('.lnkNingunoA').click(function(){
				id = $(this).attr('id').substr(3);
				$('.chkAsig' + id).prop('checked', false);
			});

			//Emisión
			$('.lnkTodosE').click(function(){
				id = $(this).attr('id').substr(3);
				$('.chkEmi' + id).prop('checked',true);
			});

			$('.lnkNingunoE').click(function(){
				id = $(this).attr('id').substr(3);
				$('.chkEmi' + id).prop('checked', false);
			});

			//Inscripción
			$('.lnkTodosI').click(function(){
				id = $(this).attr('id').substr(3);
				$('.chkIn' + id).prop('checked',true);
			});

			$('.lnkNingunoI').click(function(){
				id = $(this).attr('id').substr(3);
				$('.chkIn' + id).prop('checked', false);
			});
		});
	</script>
@stop