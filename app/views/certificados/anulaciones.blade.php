@extends('template/template')

@section('content')
  <h1 class="titulo">Anulación de certificado</h1>
  <div class="contenido contenido-full">
    <div class="col-md-12">
      {{ Form::open(array('class'=>'form-horizontal', 'id'=>'frmAnulacion')) }}
          <div class="form-group">
            <label for="txMotivo" class="col-sm-2 control-label"><span id="disponible">Motivo</span></label>
            <div class="col-sm-8 div-contingente">
              {{ Form::textarea('txMotivo', '', array('class'=>'form-control', 
                'data-bv-notEmpty'         => 'true',
                'data-bv-notEmpty-message' => 'El motivo de anulación es requerido',
                'autocomplete'             => 'off'
              )) }}
            </div>
          </div> 
          <hr>
          <div class="row">
            <div class="col-xs-4 pull-left">
              <div id="mensajes"></div>
            </div>
            <div class="col-md-12 text-center">
              <input type="submit" class="btn btn-large btn-primary" value="Anular certificado">
            </div>
          </div>
        {{ Form::hidden('certificado', $certificado) }}
      {{Form::close()}}
    </div>
    <div class="clearfix"></div>
  </div>
  
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