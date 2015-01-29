@extends('template/template')

@section('content')
	<h3 class="text-primary">Liquidación de certificado</h3>
	{{Form::open(array('class'=>'form-horizontal', 'id'=>'frmLiquidacion')) }}
		<div class="col-md-12">
      <div class="form-group">
        <label for="txDua" class="col-sm-2 control-label">DUA:</label>
        <div class="col-sm-8">
          {{ Form::text('txDua', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'La DUA es requerida',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="txCantidad" class="col-sm-2 control-label">Cantidad real:</label>
        <div class="col-sm-8">
          {{ Form::text('txCantidad', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'La cantida es requerida',
            'data-bv-numeric'          => 'true',
            'data-bv-numeric-message'  => 'La cantidad debe ser numerica',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>
    <div class="col-md-12">
    	<div class="form-group">
    		<div class="col-sm-2">&nbsp;</div>
    		<div class="col-sm-8">
    			<input type="submit" class="btn btn-large btn-success" value="Liquidar">
    		</div>
    	</div>
		</div>
  {{Form::close()}}

  <script>
  	$(document).ready(function(){
	  	$('#frmLiquidacion')
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