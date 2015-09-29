@extends('template/template')

@section('content')
	<h3 class="text-primary">Penalizaciones y devoluciones para períodos</h3>
	{{ Form::open(array('url'=>'periodospenalizaciones?periodo='.$periodoid, 'class'=>'form-horizontal', 'id'=>'frmAsignacion')) }}
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
      <label for="txCantidad" class="col-sm-4 control-label">Empresa:</label>
      <div class="col-sm-8">
      	<select id="cmbEmpresa" name="cmbEmpresa" class="selectpicker form-control">
      		@foreach($empresas as $empresa)
						<option value="{{ Crypt::encrypt($empresa->empresaid) }}">{{ $empresa->nombre }}</option>
      		@endforeach
      	</select>
      </div>
    </div>
    <div class="form-group col-sm-6">
      <label for="txCantidad" class="col-sm-4 control-label">Cantidad:</label>
      <div class="col-sm-8">
      	{{ Form::text('txCantidad', '', array('class'=>'form-control', 'data-bv-notEmpty'=>'true', 'data-bv-numeric'=>'true', 'data-bv-notempty-message'=>'La cantidad es requerida', 'data-bv-numeric-message'=>'La cantidad debe ser un número','data-bv-greaterthan'=>'true','data-bv-greaterthan-value'=> 0,'data-bv-greaterthan-inclusive'=>'false','data-bv-greaterthan-message'=>'El valor debe ser mayor que cero.')) }}
      </div>
    </div>
    <div class="form-group col-sm-6">
      <label for="txCantidad" class="col-sm-4 control-label">Tipo:</label>
      <div class="col-sm-8">
        <select id="cmbTipo" name="cmbTipo" class="selectpicker form-control">
          <option value="{{ Crypt::encrypt(4) }}">Penalización</option>
          <option value="{{ Crypt::encrypt(3) }}">Devolución</option>
        </select>
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
      	{{ Form::submit('Guardar', array('class'=>'btn btn-success')) }}
      </div>
    </div>
	{{ Form::close() }}

	<script>
	$(document).ready(function(){
		$('.selectpicker').selectpicker();

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