@extends('template/template')

@section('content')
	<h3 class="text-primary">Detalle solicitud - Emisión</h3>
	<div class="col-sm-12">
		<dl class="dl-horizontal">
			<dt>Fecha:</dt><dd>{{ $solicitud->created_at }}</dd>
			<dt>Nombre:</dt><dd>{{ $solicitud->nombre }}</dd>
	    <dt>Email:</dt><dd>{{ $solicitud->email }}</dd>
	    <dt>Tratado:</dt><dd>{{ $solicitud->tratado }}</dd>
	    <dt>Producto:</dt><dd>{{ $solicitud->producto }}</dd>
	    <dt>Monto Solicitado:</dt><dd>{{ $solicitud->solicitado.' '.$solicitud->unidad }}</dd>
		</dl>
	</div>
	<h4 class="text-warning">Documentos</h4>
	<ul class="list-group">
		@foreach ($requerimientos as $requerimiento)
	    <li class="list-group-item">
	    	<a class="btn btn-default btn-xs" target="_blank" href="/archivos/{{ $solicitud->usuarioid. '/' . $requerimiento->archivo}}">
	    	<span class="fa fa-cloud-download"></span>
	    	</a>&nbsp;{{$requerimiento->nombre}}
	    </li>
		@endforeach
	</ul>
	
	{{Form::open(array('id'=>'frmAuto', 'route'=>'solicitudespendientes.emision.store'))}}
		<h4 class="text-warning">Cantidad Autorizada</h4>
		<div class="form-group" id="divCantidad">
			{{ Form::text('txCantidad', $solicitud->solicitado, array(
				'class'                    => 'form-control',
				'data-bv-notempty'         => 'true',
				'data-bv-numeric'          => 'true',
				'data-bv-notempty-message' => 'La cantidad es requerida',
				'data-bv-numeric-message'  => 'El valor debe ser numérico')) }}
		</div>
		<h4 class="text-warning">Observaciones</h4>
		<div class="form-group" id="divObservaciones">
		  <textarea class="form-control" rows="3" name="txObservaciones" id="txObservaciones" 
		  	data-bv-notempty="true"
		  	data-bv-notempty-message="La observación es requerida para rechazos"></textarea>
		</div>
		<button type="submit" class="btn btn-success" name="btnAutorizar" value="1" id="btnAutorizar" autocomplete="off">Autorizar</button>
		<button type="submit" class="btn btn-danger" name="btnRechazar" value="1" id="btnRechazar" autocomplete="off">Rechazar</button>
		{{Form::hidden('id',Request::segment(3))}}
	{{Form::close()}}
	<script>
		$(document).ready(function(){
			$('#btnAutorizar').click(function(){
				$('#txObservaciones').hide();
			});
			$('#frmAuto').bootstrapValidator({
				feedbackIcons: {
	        valid: 'glyphicon glyphicon-ok',
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	      },
	    });
		});
	</script>

@stop