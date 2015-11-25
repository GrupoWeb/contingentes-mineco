@extends('template/template')

@section('content')
	<h1 class="titulo">Detalle solicitud - Asignación</h1>
	<div class="contenido contenido-full">
		<div class="col-sm-12">
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
			<div class="col-sm-2"><strong>Monto Solicitado:</strong></div>
			<div class="col-sm-10">{{ number_format($solicitud->solicitado, 3).' '.$solicitud->unidad }}</div>
			<div class="clearfix"></div>
			<br />

			<h4 class="titulo">Documentos</h4>
			@if(count($requerimientos) == 0)
				Para esta solicitud no se tienen documentos adjuntos.
			@endif
			<ul class="list-group">
				@foreach ($requerimientos as $requerimiento)
			    <li class="list-group-item">
			    	<a target="_blank" href="/archivos/{{$solicitud->usuarioid. '/' . $requerimiento->archivo}}">{{$requerimiento->nombre}}
			    	</a>
			    </li>
				@endforeach
			</ul>
			<br />
			
			<h4 class="titulo">Cantidad Autorizada</h4>
			{{Form::open(array('id'=>'frmAuto', 'route'=>'solicitudespendientes.asignacion.store'))}}
				<div class="form-group" id="divCantidad">
					{{ Form::text('txCantidad', $solicitud->solicitado, array(
						'class'                         => 'form-control',
						'data-bv-notempty'              => 'true',
						'data-bv-numeric'               => 'true',
						'data-bv-greaterthan'           =>'true',
						'data-bv-greaterthan-value'     => 0,
						'data-bv-greaterthan-inclusive' => 'false',
						'data-bv-greaterthan-message'   => 'El valor debe ser mayor que cero.',
						'data-bv-lessthan'              =>'true',
						'data-bv-lessthan-value'        => $maximo,
						'data-bv-lessthan-inclusive'    => 'true',
						'data-bv-lessthan-message'      => 'El valor debe ser menor al monto disponible.',
						'data-bv-notempty-message'      => 'La cantidad es requerida',
						'data-bv-numeric-message'       => 'El valor debe ser numérico')) }}
				</div>
				<p>* Máximo disponible: {{ number_format($maximo, 3) }}</p>

				<h4 class="titulo">Número de Acta</h4>
				<div class="form-group" id="divActa">
					{{ Form::text('txActa', '', array('class'=>'form-control','data-bv-notempty'=>'true','data-bv-notempty-message'=>'El acta es requerida')) }}
				</div>

				<h4 class="titulo">Observaciones</h4>
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

			$('#btnRechazar').click(function(){
				$('#frmAuto').data('bootstrapValidator').enableFieldValidators('txCantidad', false);
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