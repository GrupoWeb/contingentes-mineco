@extends('template/template')

@section('content')
	<h3 class="text-primary">{{$titulo}}</h3>
  {{Form::open(array('class'=>'form-horizontal', 'target'=>'_blank', 'id'=>'frmFiltros'))}}
	  <div class="panel panel-default">
	    <br>
	    @if(in_array('solotratados', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Tratados:</label>
	          <div class="col-sm-10">
	            <select id="tratadoid" name="tratadoid" class="selectpicker form-control">    
	              @foreach ($tratados as $tratado)
	                <option value="{{ Crypt::encrypt($tratado->tratadoid) }}">{{ $tratado->nombrecorto }}</option>
	              @endforeach
	            </select>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Contingentes:</label>
	          <div class="col-sm-10"><div id="contingentediv"></div></div>
	        </div>
	      </div>
	    @endif
	    @if(in_array('tratados', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Tratados:</label>
	          <div class="col-sm-10">
	            <select id="tratadoid" name="tratadoid" class="selectpicker form-control">    
	              @foreach ($tratados as $tratado)
	                <option value="{{ Crypt::encrypt($tratado->tratadoid) }}">{{ $tratado->nombrecorto }}</option>
	              @endforeach
	            </select>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Contingentes:</label>
	          <div class="col-sm-10"><div id="contingentediv"></div></div>
	        </div>
	      </div>
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="tratadoid">Empresas:</label>
	          <div class="col-sm-10"><div id="empresadiv"></div></div>
	        </div>
	      </div>
	    @endif
	    @if(in_array('fechaini', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="fechaini">Fecha Inicial:</label>
	          <div class="col-sm-10">
	            <?php $iniciomes = date('01/m/Y'); ?>
		          <div class="input-group date catalogoFecha">
		            {{ Form::text('fechaini', $iniciomes , array('class'=>'form-control', 'data-format'=>'dd/MM/yyyy')) }}
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
	    @if (in_array('contingentes', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="cmbContingente">Contingente:</label>
	          <div class="col-sm-8">
	            @include('partials/contingente', array('nombre'=>'cmbContingente','id'=>'cmbContingente','tipo'=>'single'))
	          </div>
	        </div>
	      </div>
	      @if(in_array('periodos', $filters))
	        <div class="col-sm-12">
	          <div class="form-group">
	            <label class="col-sm-2 control-label" for="cmbPeriodo">Periodo:</label>
	            <div class="col-sm-10" id="pid"></div>
	          </div>
	        </div>
	      @endif
	      @if(in_array('empresas', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="cmbEmpresa">Empresa:</label>
	          <div class="col-sm-8" id="eid"></div>
	        </div>
	      </div>
	      @endif
	    @endif
	    @if(in_array('productos', $filters))
	      <div class="col-sm-12">
	        <div class="form-group">
	          <label class="col-sm-2 control-label" for="productoid">Productos:</label>
	          <div class="col-sm-10">
	            <select name="productoid" class="selectpicker">    
	              <option value="0">(Todos)</option>       
	              @foreach ($productos as $producto)
	                <option value="{{ $producto->productoid }}">{{$producto->nombre}}</option>
	              @endforeach
	            </select>
	          </div>
	        </div>
	      </div>
	    @endif
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
			$('.catalogoFecha').datetimepicker({
				locale: 'es',
        format : 'DD/MM/YYYY',
				useCurrent: true
			});

	    $('.selectpicker').selectpicker();

	    @if(in_array('contingentes', $filters))
	      $('#cmbContingente').change(function(){
	        $('#pid').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
	        $('#eid').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');

	        $.get('cuentacorriente/periodos/' + $(this).find('option:selected').val(), function(data){
	        	console.log(data);
            if(data.codigoerror != 0) {
              alert( "Error: " + data.error);
              window.location = '/';
            }
            else
	          	$('#pid').html(data.data);
	        });

	        @if (in_array('empresas', $filters))
	          $.get('cuentacorriente/empresas/' + $(this).find('option:selected').val(), function(data){
	            $('#eid').html(data);
	          });
	        @endif

	      });

	      $('#cmbContingente').change();
	    @endif

	    @if(in_array('tratados', $filters))
	    	$('#tratadoid').change(function(){
	    		$('#contingentediv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
	    		$('#empresadiv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');

	    		$.get('utilizacion/contingentes/' + $(this).find('option:selected').val(), function(data){
	          $('#contingentediv').html(data);
	        });
	    	});

	    	$('#tratadoid').change();
	    @endif

	    @if(in_array('solotratados', $filters))
	    	$('#tratadoid').change(function(){
	    		$('#contingentediv').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');

	    		$.get('utilizacion/contingentes/' + $(this).find('option:selected').val(), function(data){
	          $('#contingentediv').html(data);
	        });
	    	});

	    	$('#tratadoid').change();
	    @endif
		});
	</script>
@stop