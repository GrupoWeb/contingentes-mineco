@extends('template/template')
@section('content')
	{{ HTML::style('http://fonts.googleapis.com/css?family=Archivo+Narrow|Raleway:400,700') }}
	{{ HTML::style('css/dace.css') }}

	<h1 class="titulo">Detalle solicitud - Inscripción</h1>
	<h4 class="titulo">Datos Generales</h4>
	<div class="col-sm-2"><strong>Fecha:</strong></div>
	<div class="col-sm-10">{{$solicitud->created_at}}</div>
	<div class="col-sm-2"><strong>Razón Social:</strong></div>
	<div class="col-sm-10">{{$solicitud->nombre}}</div>
	<div class="col-sm-2"><strong>Email:</strong></div>
	<div class="col-sm-10">{{$solicitud->email}}</div>
	<div class="col-sm-2"><strong>Tratado:</strong></div>
	<div class="col-sm-10">{{$solicitud->tratado}}</div>
	<div class="col-sm-2"><strong>Contingente:</strong></div>
	<div class="col-sm-10">{{$solicitud->producto}}</div>
	<div class="col-sm-2">&nbsp;</div>
	<div class="col-sm-10"><a href="#" data-toggle="modal" data-target="#formularioModal">(Ver formulario)</a></div>
	<div class="clearfix"></div>
	<br />
	<h4 class="titulo">Documentos</h4>
	<ul class="list-group">
		@foreach ($requerimientos as $requerimiento)
	    <li class="list-group-item">
	    	<a target="_blank" href="/archivos/solicitudes/{{$requerimiento->solicitudinscripcionid. '/' . $requerimiento->archivo}}">{{$requerimiento->nombre}}
	    	</a>
	    </li>
		@endforeach
	</ul>
	<br />
	<h4 class="titulo">Observaciones</h4>
	{{Form::open(array('id'=>'frmAuto', 'route'=>'solicitudespendientes.inscripcion.store'))}}
		{{ Form::hidden('cid', $cid) }}
		<div class="form-group" id="divObservaciones">
		  <textarea class="form-control" rows="3" name="txObservaciones" id="txObservaciones" 
		  	data-bv-notempty="true"
		  	data-bv-notempty-message="La observación es requerida para rechazos"></textarea>
		</div>
		<button type="submit" class="btn btn-success-mineco" name="btnAutorizar" value="1" id="btnAutorizar" autocomplete="off">Autorizar</button>
		<button type="submit" class="btn btn-danger-mineco" name="btnRechazar" value="1" id="btnRechazar" autocomplete="off">Rechazar</button>
		{{Form::hidden('id',Request::segment(3))}}
	{{Form::close()}}

	<div class="modal fade" id="formularioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Formulario de inscripción</h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-bordered table-condensed">
						<tr>
							<th>Fecha</th>
							<td>{{ $solicitud->created_at }}</td>
						</tr>
						<tr>
							<th>NIT</th>
							<td>{{ $solicitud->nit }}</td>
						</tr>
						<tr>
							<th>Razón social</th>
							<td>{{ $solicitud->nombre }}</td>
						</tr>
						<tr>
							<th>Representante legal</th>
							<td>{{ $solicitud->propietario }}</td>
						</tr>
						<tr>
							<th>Email</th>
							<td>{{ $solicitud->email }}</td>
						</tr>
						<tr>
							<th>Teléfono</th>
							<td>{{ $solicitud->telefono }}</td>
						</tr>
						<tr>
							<th>Fax</th>
							<td>{{ $solicitud->fax }}</td>
						</tr>
						<tr>
							<th>Domicilio fiscal</th>
							<td>{{ $solicitud->domiciliofiscal }}</td>
						</tr>
						<tr>
							<th>Domicilio comercial</th>
							<td>{{ $solicitud->domiciliocomercial }}</td>
						</tr>
						<tr>
							<th>Lugar para recibir notificaciones</th>
							<td>{{ $solicitud->direccionnotificaciones }}</td>
						</tr>
						<tr>
							<th>Encargado</th>
							<td>{{ $solicitud->encargadoimportaciones }}</td>
						</tr>
	      	</table>
	      </div>
	    </div>
	  </div>
	</div>

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