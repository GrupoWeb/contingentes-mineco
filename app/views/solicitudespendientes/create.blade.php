@extends('template/template')
@section('content')
<?php $usuarioid = Crypt::encrypt($solicitud[0]->usuarioid); ?>
<h1>Detalle solicitud</h1>
<div>
	<div class="row">
		<div class="col-md-4">
			<dl class="dl-horizontal">
				<dt>Fecha:</dt><dd>{{$solicitud[0]->created_at}}</dd>
				<dt>Nombre:</dt><dd>{{$solicitud[0]->nombre}}</dd>
		    <dt>Email:</dt><dd>{{$solicitud[0]->email}}</dd>
		    <dt>Producto:</dt><dd>{{$solicitud[0]->nombre}}</dd>
			</dl>
			{{Form::open(array('url'=>'catalogos/solicitudespendientes/autorizar/'.$usuarioid,'type'=>'post','id'=>'frmAuto'));}}
				<div class="form-group" id="divObservaciones">
			    <label for="txObservaciones">Observaciones</label>
			    <textarea class="form-control" rows="3" name="txObservaciones" id="txObservaciones" ></textarea>
			  </div>
				<button class="btn btn-success">Autorizar</button>
				<button class="btn btn-danger" id="rechazar">Rechazar</button>
				{{Form::hidden('act', 1,array('id'=>'act'));}}
			{{Form::close();}}
		</div>
		<div class="col-md-4">
				<h3>Documentos:</h3>
				<div class="list-group">
					@foreach ($requerimientos as $requerimiento)
						<div href="#" class="list-group-item">
					    <h4 class="list-group-item-heading">{{$requerimiento->nombre}}</h4>
					    <p class="list-group-item-text"><a class="btn btn-default" href="{{'../../../archivos/' .$requerimiento->usuarioid. '/' . $requerimiento->archivo}}">Descargar</a></p>
					  </div>
					@endforeach
				</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#rechazar').on('click',function(event){
			if($('#txObservaciones').val()=="")
			{
				$('#divObservaciones').removeClass('has-success has-feedback').addClass('has-error has-feedback');
				$('#divObservaciones > span').remove();
				$('#divObservaciones').append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			}
			else
			{
				$('#act').val(2);
				return;
			}
			event.preventDefault();
		});

		$('#txObservaciones').keypress('keyup',function(event){
			if($('#txObservaciones').val()!="")
			{
				console.log($('#txObservaciones').val());
				$('#divObservaciones').removeClass('has-error has-feedback').addClass('has-success has-feedback');
				$('#divObservaciones > span').remove();
				$('#divObservaciones').append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
			}
			else
			{
				console.log($('#txObservaciones').val());
				$('#divObservaciones').removeClass('has-success has-feedback').addClass('has-error has-feedback');
				$('#divObservaciones > span').remove();
				$('#divObservaciones').append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			}
		});

	});
</script>
@stop