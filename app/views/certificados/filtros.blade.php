@extends('template.template')

@section('content')
	<h3 class="text-primary">{{$titulo}}</h3>

	{{Form::open(array('class'=>'form-horizontal', 'target'=>'_blank', 'id'=>'frmFiltros'))}}
	  <div class="panel panel-default"><br>
      <div class="col-sm-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="tratadoid">Tratados:</label>
          <div class="col-sm-10">
            <select id="tratadoid" name="tratadoid" class="selectpicker form-control">    
            	@if(in_array('tratados', $todos))
            		<option value="{{Crypt::encrypt('-1')}}">Todos</option>
            	@endif
              @foreach ($tratados as $tratado)
                <option value="{{ Crypt::encrypt($tratado->tratadoid) }}">{{ $tratado->nombrecorto }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div> <!-- PERIODOS -->
      <div class="col-sm-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="contingentes">Contingentes:</label>
          <div class="col-sm-10"><div id="contingentediv"></div></div>
        </div>
      </div> <!-- CONTINGENTES -->
      <div class="col-sm-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="cmbPeriodo">Periodo:</label>
          <div class="col-sm-10" id="periodosdiv"></div>
        </div>
      </div> <!-- PERIODOS -->
      <div class="col-sm-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="tratadoid">Empresas:</label>
          <div class="col-sm-10"><div id="empresadiv"></div></div>
        </div>
      </div> <!-- EMPRESAS -->
      <div class="col-sm-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="fechaini">Fecha Inicial:</label>
          <div class="col-sm-10">
            <?php $inicioano = date('01/01/Y'); ?>
	          <div class="input-group date catalogoFecha">
	            {{ Form::text('fechaini', $inicioano , array('class'=>'form-control', 'data-format'=>'dd/MM/yyyy')) }}
	            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	          </div>
          </div>
        </div>
      </div> <!-- FECHA INICIO -->
      <div class="col-sm-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="fechafin">Fecha Final:</label>
          <div class="col-sm-10">
            <?php $hoy = date('d/m/Y'); ?>
	          <div class="input-group date catalogoFecha">
	            {{ Form::text('fechafin', $hoy, array('class'=>'form-control','data-format'=>'dd/MM/yyyy')) }}
	            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	          </div>
          </div>
        </div>
      </div> <!-- FECHA FIN -->
			<div class="clearfix"></div>
	  </div>
	{{Form::close()}}

	<script type="text/javascript">
		$(function() {
			$('.catalogoFecha').datetimepicker({
				locale: 'es',
        format : 'DD/MM/YYYY',
				useCurrent: true
			});

	    $('.selectpicker').selectpicker();

	    $('#tratadoid').change(function(){
	    	$('#contingentediv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
	    	$.get('certificados/contingentes/' + $(this).find('option:selected').val(), function(data) {
	    		$('#contingentediv').html(data);
	        $('#cmbContingente').selectpicker();
	        $('#cmbContingente').change();
	    	});
	    });

	    $('#tratadoid').change();

	    $(document).on('change','#cmbContingente', function(){
	    	$('#periodosdiv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
	    	$.get('certificados/periodos/' + $(this).find('option:selected').val(), function(data) {
	    		$('#periodosdiv').html(data);
	        $('#cmbPeriodos').selectpicker();
	        $('#cmbPeriodos').change();
	    	});
	    });

	    $(document).on('change','#cmbPeriodos', function(){
	    	$('#empresadiv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');

	    	$.get('certificados/empresas/' + $(this).find('option:selected').val(), function(data) {
	    		$('#empresadiv').html(data);
	    		$('#cmbEmpresas').selectpicker();
	    	});
	    });

	  });
	</script>
@stop