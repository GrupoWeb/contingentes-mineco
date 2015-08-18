@extends('template/template')

@section('content')
	<h3 class="text-primary">{{$titulo}}</h3>
  {{Form::open(array('class'=>'form-horizontal', 'target'=>'_blank', 'id'=>'frmFiltros'))}}
	  <div class="panel panel-default">
	    <br>
	    @if(in_array('tratados', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Tratados:</label>
	          <div class="col-sm-10">
	            <select id="tratadoid" name="tratadoid" class="selectize form-control" data-bv-notEmpty="true" data-bv-notEmpty-message="Campo requerido">    
	            	@if(in_array('tratados', $todos))
	            		<option value="{{Crypt::encrypt('-1')}}">Todos</option>
	            	@endif
	              @foreach ($tratados as $tratado)
	                <option value="{{ Crypt::encrypt($tratado->tratadoid) }}">{{ $tratado->nombrecorto }}</option>
	              @endforeach
	            </select>
	          </div>
	        </div>
	      </div>
	    @endif

	    @if(in_array('contingentes', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="contingentes">Contingentes:</label>
	          <div class="col-sm-10"><div id="contingentediv"></div></div>
	        </div>
	      </div>
	    @endif

	    @if(in_array('empresas', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Empresas:</label>
	          <div class="col-sm-10"><div id="empresadiv"></div></div>
	        </div>
	      </div>
	    @endif

	    @if(in_array('periodos', $filters))
        <div class="col-sm-12">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="cmbPeriodo">Periodo:</label>
            <div class="col-sm-10" id="periodosdiv"></div>
          </div>
        </div>
	    @endif

	    @if(in_array('fechaini', $filters))
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
	      </div>
	    @endif

	    @if(in_array('fechafin', $filters))
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
	      </div>
	    @endif

	    @if(in_array('productos', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="productoid">Productos:</label>
	          <div class="col-sm-10">
	            <select name="productoid" class="selectize">    
	              <option value="0">(Todos)</option>       
	              @foreach ($productos as $producto)
	                <option value="{{ $producto->productoid }}">{{$producto->nombre}}</option>
	              @endforeach
	            </select>
	          </div>
	        </div>
	      </div>
	    @endif

	    @if(in_array('formato', $filters))
		    <div class="col-sm-12">
		      <div class="form-group">
		        <label class="col-sm-2 control-label" for="formato">Formato:</label>
		        <div class="col-sm-10">
		          <div class="radio">
		            <label>
		              <input type="radio" name="formato" id="formatoHTML" value="html" checked>
		              HTML
		            </label>
		          </div>
		          <div class="radio">
		            <label>
		              <input type="radio" name="formato" id="formatoPDF" value="pdf">
		              PDF
		            </label>
		          </div>
		          <div class="radio">
		            <label>
		              <input type="radio" name="formato" id="formatoExcel" value="excel">
		              Excel
		            </label>
		          </div>
		        </div>
		      </div>
		    </div>
		  @endif
	    <div class="col-sm-12">
	      <div class="form-group">
	        <div class="col-sm-2">&nbsp;</div>
	        <div class="col-sm-10"> 
	          <button class="btn btn-success" type="submit">Generar</button>
	        </div>
	      </div>
	    </div>
	    <div class="clearfix"></div>
	  </div>
	{{Form::close()}}

	<script type="text/javascript">
		$(function() {

			$('#frmFiltros').bootstrapValidator({
        excluded: [':disabled'],
        feedbackIcons: {
          valid: '',
          invalid: '',
          validating: ''
        }
      });

			$('.catalogoFecha').datetimepicker({
				locale: 'es',
        format : 'DD/MM/YYYY',
				useCurrent: true
			});

	    //$('.selectpicker').selectize();
	    $('.selectize').selectize();

	    @if(in_array('tratados', $filters))
	    	$('#tratadoid').change(function(){
	    		@if(in_array('empresas', $filters))
	    			$('#empresadiv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
	    		@endif
	    		@if(in_array('periodos', $filters))
	    			$('#periodosdiv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
	    		@endif
	    		@if(in_array('contingentes', $filters))
	    			if($(this).find('option:selected').val() != '') {
		    			$('#contingentediv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
		    			$.get('utilizacion/contingentes/' + $(this).find('option:selected').val() + '{{(in_array('contingentes', $todos)?'?todos=1':'')}}', function(data){
		          	$('#contingentediv').html(data);
		          	$('#cmbContingente').selectize();
		          	$('#frmFiltros').bootstrapValidator('addField', $('#cmbContingente'));
		          	$('#cmbContingente').change();
		        	});
		        }
	    		@endif
	    	});
	    	$('#tratadoid').change();
	    @endif

	    @if(in_array('contingentes', $filters))
	    	$(document).on('change','#cmbContingente', function(){
	    		if($(this).find('option:selected').val() != '') {
		    		@if(in_array('empresas', $filters))
		    			$('#empresadiv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
			    		$.get('utilizacion/empresas/' + $(this).find('option:selected').val() + '{{(in_array('empresas', $todos)?'?todos=1':'')}}', function(data){
		        		$('#empresadiv').html(data);
		        		$('#cmbEmpresa').selectize();
		        		$('#frmFiltros').bootstrapValidator('addField', $('#cmbEmpresa'));
		      		});
	      		@endif
	      		
	      		@if(in_array('periodos', $filters))
			    		$.get('cuentacorriente/periodos/' + $(this).find('option:selected').val() + '{{(in_array('periodos', $todos)?'?todos=1':'')}}', function(data){
		        		if(data.codigoerror != 0) {
	              	alert( "Error: " + data.error);
	              	window.location = '/';
		            }
		            else {
			          	$('#periodosdiv').html(data.data);
			          	$('#cmbPeriodo').selectize();
			          	$('#frmFiltros').bootstrapValidator('addField', $('#cmbPeriodo'));
		            }
			      	});
	      		@endif
	      	}
	    	});
	    @endif
		});
	</script>
@stop