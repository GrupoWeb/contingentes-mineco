@extends('template/template')

@section('content')
	<h3 class="text-primary">Anulación de certificado</h3>
	{{Form::open(array('class'=>'form-horizontal', 'id'=>'frmAnulacion')) }}
		<div class="col-md-12">
      <div class="form-group">
        <label for="txMotivo" class="col-sm-2 control-label">Motivo:</label>
        <div class="col-sm-8">
          {{ Form::textarea('txMotivo', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El motivo de anulación es requerido',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>
    <div class="col-md-12">
    	<div class="form-group">
    		<div class="col-sm-8 col-sm-offset-2">
    			<input type="submit" class="btn btn-large btn-danger" value="Anular">
    		</div>
    	</div>
		</div>
		{{ Form::hidden('certificado', $certificado) }}
  {{Form::close()}}

  <script>
  	$(document).ready(function(){
	  	$('#frmAnulacion')
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