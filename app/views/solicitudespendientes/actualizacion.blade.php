@extends('template/template')
@section('content')
	<h1 class="titulo">Detalle solicitud - Actualización</h1>
	<div class="contenido contenido-full">
		<div class="col-sm-12">
			<h4 class="titulo">Datos Generales</h4>
			<div class="col-sm-2"><strong>Empresa:</strong></div>
			<div class="col-sm-10">{{$empresa->razonsocial}}</div>
			<div class="col-sm-2"><strong>NIT:</strong></div>
			<div class="col-sm-10">{{$empresa->nit}}</div>
			<div class="col-sm-2"><strong>Fecha:</strong></div>
			<div class="col-sm-10">{{$solicitud->created_at}}</div>
			<div class="col-sm-2"><strong>Propietario:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->propietario <> $empresa->propietario) ? 'text-danger' : '' }}">{{ $solicitud->propietario }}</div>
			<div class="col-sm-2"><strong>Domicilio Fiscal:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->domiciliofiscal <> $empresa->domiciliofiscal) ? 'text-danger' : '' }}">{{$solicitud->domiciliofiscal}}</div>
			<div class="col-sm-2"><strong>Domicilio Comercial:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->domiciliocomercial <> $empresa->domiciliocomercial) ? 'text-danger' : '' }}">{{$solicitud->domiciliocomercial}}</div>
			<div class="col-sm-2"><strong>Dir. Notificaciones:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->direccionnotificaciones <> $empresa->direccionnotificaciones) ? 'text-danger' : '' }}">{{$solicitud->direccionnotificaciones}}</div>
			<div class="col-sm-2"><strong>Teléfono:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->telefono <> $empresa->telefono) ? 'text-danger' : '' }}">{{$solicitud->telefono}}</div>
			<div class="col-sm-2"><strong>FAX:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->fax <> $empresa->fax) ? 'text-danger' : '' }}">{{$solicitud->fax}}</div>
			<div class="col-sm-2"><strong>Encargado:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->encargadoimportaciones <> $empresa->encargadoimportaciones) ? 'text-danger' : '' }}">{{$solicitud->encargadoimportaciones}}</div>
			<div class="col-sm-2"><strong>Código VUPE:</strong></div>
			<div class="col-sm-10 {{ ($solicitud->codigovupe <> $empresa->codigovupe) ? 'text-danger' : '' }}">{{$solicitud->codigovupe}}</div>
			<div class="clearfix"></div>
			<br />
			<h4 class="titulo">Documentos</h4>
			@if(count($documentos) == 0)
				Para esta solicitud no se tienen documentos adjuntos.
			@endif
			<ul class="list-group">
				@foreach ($documentos as $documento)
			    <li class="list-group-item">
			    	<a target="_blank" href="/archivos/actualizaciones/{{ $solicitud->actualizacionid. '/' . $documento }}">{{ $documento }}
			    	</a>
			    </li>
				@endforeach
			</ul>
			<br />
			<h4 class="titulo">Observaciones</h4>
			{{Form::open(array('id'=>'frmAuto', 'route'=>'solicitudespendientes.actualizacion.store'))}}
				<div class="form-group" id="divObservaciones">
				  <textarea class="form-control" rows="3" name="txObservaciones" id="txObservaciones" 
				  	data-bv-notempty="true"
				  	data-bv-notempty-message="La observación es requerida para rechazos"></textarea>
				</div>
				<button type="submit" class="btn btn-success-mineco" name="btnAutorizar" value="1" id="btnAutorizar" autocomplete="off">Autorizar</button>
				<button type="submit" class="btn btn-danger-mineco" name="btnRechazar" value="1" id="btnRechazar" autocomplete="off">Rechazar</button>
				{{Form::hidden('id',Request::segment(3))}}
			</div>
			<div class="clearfix"></div>
		</div>
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