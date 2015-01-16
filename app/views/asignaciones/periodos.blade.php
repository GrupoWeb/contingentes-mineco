@extends('template/template')

@section('content')
	<h2>Asignación de cuotas para períodos</h2>
	{{ Form::open(array('url'=>'periodosasignaciones?periodo='.$periodoid, 'class'=>'form-horizontal', 'id'=>'frmAsignacion')) }}
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

    @if($periodo->tipotratadoid == 2)
			<div class="form-group col-sm-6">
	      <label for="txCantidad" class="col-sm-4 control-label">Cantidad:</label>
	      <div class="col-sm-8">
	      	<select name="cmbUsuario" class="selectpicker form-control" title="Seleccione un usuario" data-bv-notEmpty="true" data-bv-notempty-message="El usuario es requerido">
            @foreach($usuarios as $usuario)
              <option value="{{ $usuario->usuarioid }}">{{ $usuario->nombre }}</option>
            @endforeach
          </select>
	      </div>
	    </div>
    @endif
    
    <div class="clearfix"></div>
		<div class="form-group col-sm-12">
      <label for="txComentario" class="col-sm-2 control-label">Comentario:</label>
      <div class="col-sm-10">
      	{{ Form::textarea('txComentario', '', array('class'=>'form-control', 'rows'=>3)) }}
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-sm-6">
      <div class="col-sm-4">&nbsp;</div>
      <div class="col-sm-8">
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
	});
	</script>
@stop