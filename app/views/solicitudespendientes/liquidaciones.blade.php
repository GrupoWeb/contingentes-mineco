@extends('template.template')

@section('content')
	<h1 class="titulo">Detalle solicitud - Liquidación</h1>
	<div class="contenido contenido-full">
		<div class="col-sm-12">
			<h4 class="titulo">Datos Generales</h4>
			<div class="col-sm-2"><strong>Certificado:</strong></div>
			<div class="col-sm-10">{{ $solicitud->numerocertificado }}</div>
			<div class="col-sm-2"><strong>Volumen:</strong></div>
			<div class="col-sm-10">{{$solicitud->volumen}}</div>
			<div class="col-sm-2"><strong>Fracción:</strong></div>
			<div class="col-sm-10">{{$solicitud->fraccion}}</div>
			<div class="col-sm-2"><strong>Razón Social:</strong></div>
			<div class="col-sm-10">{{ $solicitud->empresa }}</div>
			<div class="col-sm-2"><strong>Usuario:</strong></div>
			<div class="col-sm-10">{{ $solicitud->nombre }}</div>
			<div class="col-sm-2"><strong>Email:</strong></div>
			<div class="col-sm-10">{{ $solicitud->email }}</div>
			<div class="clearfix"></div>
			<br />
			<h4 class="titulo">Documentos</h4>
			@if($solicitud->documento == '')
				Para esta solicitud no se tienen documentos adjuntos.
			@else
				<ul class="list-group">
			    <li class="list-group-item">
			    	<a target="_blank" href="/liquidaciones/{{ $solicitud->usuarioid. '/' . $solicitud->documento }}">{{ $solicitud->documento }}
			    	</a>
			    </li>
				</ul>
			@endif
			<br />
			<h4 class="titulo">Datos Liquidación</h4>
			<div class="col-sm-2"><strong>Fecha liquidación:</strong></div>
			<div class="col-sm-10">{{ $solicitud->fecha }}</div>
			<div class="col-sm-2"><strong>DUA:</strong></div>
			<div class="col-sm-10">{{$solicitud->dua}}</div>
			<div class="col-sm-2"><strong>Valor Real:</strong></div>
			<div class="col-sm-10">{{$solicitud->real}}</div>
			<div class="col-sm-2"><strong>Valor CIF:</strong></div>
			<div class="col-sm-10">{{ $solicitud->cif }}</div>
			<br />
			<h4 class="titulo">Observaciones</h4>
			{{Form::open(array('id'=>'frmAuto', 'route'=>'solicitudespendientes.liquidacion.store'))}}
				<div class="form-group" id="divObservaciones">
				  <textarea class="form-control" rows="3" name="txObservaciones" id="txObservaciones" 
				  	data-bv-notempty="true"
				  	data-bv-notempty-message="La observación es requerida para rechazos"></textarea>
				</div>
				<button type="submit" class="btn btn-success-mineco" name="btnAutorizar" value="1" id="btnAutorizar" autocomplete="off">Autorizar</button>
				<button type="submit" class="btn btn-danger-mineco" name="btnRechazar" value="1" id="btnRechazar" autocomplete="off">Rechazar</button>
			{{ Form::hidden('id', Crypt::encrypt($solicitud->id)) }}
		</div>
		<div class="clearfix"></div>
	</div>
	<script>
		$(document).ready(function(){
			$('#btnAutorizar').click(function(){
				$('#frmAuto').data('bootstrapValidator').enableFieldValidators('txObservaciones', false);
			});

			$('#frmAuto').bootstrapValidator({
				feedbackIcons: {
	        valid: 'glyphicon glyphicon-ok',
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	      },
	      live: 'disabled',
	    });
		});
	</script>
@stop