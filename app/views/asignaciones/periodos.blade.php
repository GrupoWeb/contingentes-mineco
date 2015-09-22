@extends('template/template')

@section('content')
  {{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}

	<h3 class="text-primary">Asignación de cuotas para períodos</h3>
	{{ Form::open(array('url'=>'periodosasignaciones?periodo='.$periodoid, 'class'=>'form-horizontal', 'id'=>'frmAsignacion', 'files'=>true)) }}
		<div class="form-group col-sm-6">
      <label for="txPeriodo" class="col-sm-4 control-label">Período:</label>
      <div class="col-sm-8">
      	{{ Form::text('txPeriodo', $periodo->periodo, array('disabled'=>true, 'class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group col-sm-6">
      <label for="txTratado" class="col-sm-4 control-label">Tratado:</label>
      <div class="col-sm-8">
      	{{ Form::text('txTratado', $periodo->tratado, array('disabled'=>true, 'class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group col-sm-6">
      <label for="txTipo" class="col-sm-4 control-label">Tipo tratado:</label>
      <div class="col-sm-8">
      	{{ Form::text('txTipo', $periodo->tipo, array('disabled'=>true, 'class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group col-sm-6">
      <label for="txProducto" class="col-sm-4 control-label">Producto:</label>
      <div class="col-sm-8">
      	{{ Form::text('txProducto', $periodo->producto, array('disabled'=>true, 'class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group col-sm-6">
      <label for="txCantidad" class="col-sm-4 control-label">Cantidad:</label>
      <div class="col-sm-8">
      	{{ Form::text('txCantidad', '', array('class'=>'form-control', 'data-bv-notEmpty'=>'true', 'data-bv-numeric'=>'true', 'data-bv-notempty-message'=>'La cantidad es requerida', 'data-bv-numeric-message'=>'La cantidad debe ser un número')) }}
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group"> 
      <label for="txCantidad" class="col-sm-2 control-label">Constancia:</label>
      <div class="col-sm-10">
        <input type="file" class="file form-control" name="constancia" />
      </div>
    </div>
    <div class="clearfix"></div>
		<div class="form-group">
      <label for="txComentario" class="col-sm-2 control-label">Comentario:</label>
      <div class="col-sm-10">
      	{{ Form::textarea('txComentario', '', array('class'=>'form-control', 'rows'=>3)) }}
      </div>
    </div>
    <div class="form-group col-sm-6">
      <div class="col-sm-8 col-sm-offset-4">
      	{{ Form::submit('Asignar', array('class'=>'btn btn-success')) }}
      </div>
    </div>
	{{ Form::close() }}

	<script>
	$(document).ready(function(){
		$('#frmAsignacion')
	    .bootstrapValidator({
	      excluded: ':disabled',
	      feedbackIcons: {
	        valid: 'glyphicon glyphicon-ok',
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	      }
	  });

    $('.file').fileinput({
      browseLabel: "Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
      browseClass: "btn btn-default",
      showPreview: false,
      showRemove:  false,
      showUpload:  false,
      allowedFileExtensions: ['jpg', 'png', 'pdf'],
      msgInvalidFileExtension: 'Solo se permiten archivos jpg, png o pdf',
      msgValidationError : 'Solo se permiten archivos jpg, png o pdf',
    });

	});
	</script>
@stop