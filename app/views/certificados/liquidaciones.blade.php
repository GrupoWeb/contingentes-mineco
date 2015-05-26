@extends('template/template')

@section('content')
  <h1 class="titulo">Liquidación de certificado</h1>
    <div class="contenido contenido-full">
      <div class="col-md-12">
        {{Form::open(array('class'=>'form-horizontal', 'id'=>'frmLiquidacion')) }}
          <div class="form-group">
            <label for="txDua" class="col-sm-2 control-label">DUA</label>
            <div class="col-sm-6 div-contingente">
              {{ Form::text('txDua', '', array('class'=>'form-control', 
                'data-bv-notEmpty'         => 'true',
                'data-bv-notEmpty-message' => 'La DUA es requerida',
                'autocomplete'             => 'off'
              )) }}
            </div>
          </div> <!-- dua -->
          <div class="form-group">
            <label for="txCantidad" class="col-sm-2 control-label">Cantidad real</label>
            <div class="col-sm-6 div-contingente">
              {{ Form::text('txCantidad', '', array('class'=>'form-control', 
                'data-bv-notEmpty'         => 'true',
                'data-bv-notEmpty-message' => 'La cantida es requerida',
                'data-bv-numeric'          => 'true',
                'data-bv-numeric-message'  => 'La cantidad debe ser numerica',
                'autocomplete'             => 'off'
              )) }}
            </div>
          </div> <!-- cantidad real -->
          <div class="form-group">
            <label for="txCIF" class="col-sm-2 control-label">Valor CIF</label>
            <div class="col-sm-6 div-contingente">
              {{ Form::text('txCIF', '', array('class'=>'form-control', 
                'data-bv-notEmpty'         => 'true',
                'data-bv-notEmpty-message' => 'El valor CIF es requerido',
                'data-bv-numeric'          => 'true',
                'data-bv-numeric-message'  => 'La cantidad debe ser numerica',
                'autocomplete'             => 'off'
              )) }}
            </div>
          </div> <!-- valor CIF -->
          <div class="form-group">
            <label for="txFecha" class="col-sm-2 control-label">Fecha de liquidación:</label>
            <div class="col-sm-6">
              <div class="input-group date catalogoFechaHora">
                {{ Form::text('txFecha', '', array('class'=>'form-control','id'=>'txFecha','data-date-format'=>'DD/MM/YYYY HH:mm')) }}
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
              </div>    
            </div>
          </div> <!-- fecha liquidacion -->
          <hr>
          <div class="row">
            <div class="col-xs-4 pull-left">
              <div id="mensajes"></div>
            </div>
            <div class="col-md-12 text-center">
              <input type="submit" class="btn btn-large btn-primary" value="Liquidar certificado">
            </div>
          </div>
        {{Form::close()}}
      </div>
      <div class="clearfix"></div>
    </div>

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

      $('.catalogoFechaHora').datetimepicker({
        locale: 'es',
        useCurrent: true,
        format: 'DD-MM-YYYY HH:mm'
      });
    });
  </script>
@stop