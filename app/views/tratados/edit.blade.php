@extends('template.template')

@section('content')
	<ol class="breadcrumb">
	  <li><a href="http://contingentes.local/tratados">Tratados &amp; contingentes</a></li>
	  <li class="active">{{ $data ? 'Editar' : 'Nuevo' }}</li>
	</ol>
	
	@if($data)
		{{ Form::open(array('url'=>'tratados/'.Crypt::encrypt($data->tratadoid), 'id'=>'frmCrud', 'class'=>'form-horizontal bv-form', 'novalidate'=>'novalidate')) }}
			{{ Form::hidden('_method', 'PUT') }}
	@else
		{{ Form::open(array('url'=>'tratados', 'id'=>'frmCrud', 'class'=>'form-horizontal bv-form', 'novalidate'=>'novalidate')) }}
	@endif

		<div class="form-group">
			<label class="col-sm-2 control-label" for="nombrecorto">Nombre Corto</label>
			<div class="col-sm-10">
				{{ Form::text('nombrecorto', ($data ? $data->nombrecorto : ''), array('class'=>'form-control')) }}
    	</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nombre">Nombre</label>
			<div class="col-sm-10">
  			{{ Form::text('nombre', ($data ? $data->nombre : ''), array('class'=>'form-control')) }}
  		</div>		   
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tipo">Tipo</label>
			<div class="col-sm-4">
  			<select name="tipo" class="selectpicker form-control">
  				<option value="Importación" {{ $data ? (($data->tipo == 'Importación') ? 'selected' : '') : '' }}>Importación</option>
  				<option value="Exportación" {{ $data ? (($data->tipo == 'Exportación') ? 'selected' : '') : '' }}>Exportación</option>
  			</select>
  		</div>		   
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="mesesvalidez">Validez (meses)</label>
			<div class="col-sm-10">
				{{ Form::text('mesesvalidez', ($data ? $data->mesesvalidez : ''), array('class'=>'form-control')) }}
  		</div>		   
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="variacion">Variación (%)</label>
			<div class="col-sm-10">
				{{ Form::text('variacion', ($data ? $data->variacion : ''), array('class'=>'form-control')) }}
  		</div>		   
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="paisid">País</label>
			<div class="col-sm-4">
  			<select name="paisid" class="selectpicker form-control">
  				@foreach($paises as $pais)
						<option value="{{ $pais->paisid }}" {{ $data ? (($data->paisid == $pais->paisid) ? 'selected' : '') : '' }}>{{ $pais->nombre }}</option>
  				@endforeach
  			</select>
  		</div>		   
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="clase">Color</label>
			<div class="col-sm-4">
  			<select name="clase" class="selectpicker form-control">
  				<option data-content="<span class='label label-success'>Verde</span>" value="success" {{ $data ? (($data->clase == 'success') ? 'selected' : '') : '' }}>Verde</option>
  				<option data-content="<span class='label label-warning'>Amarillo</span>" value="warning" {{ $data ? (($data->clase == 'warning') ? 'selected' : '') : '' }}>Amarillo</option>
  				<option data-content="<span class='label label-danger'>Rojo</span>" value="danger" {{ $data ? (($data->clase == 'danger') ? 'selected' : '') : '' }}>Rojo</option>
  				<option data-content="<span class='label label-primary'>Azul</span>" value="primary" {{ $data ? (($data->clase == 'primary') ? 'selected' : '') : '' }}>Azul</option>
  				<option data-content="<span class='label label-info'>Celeste</span>" value="info" {{ $data ? (($data->clase == 'info') ? 'selected' : '') : '' }}>Celeste</option>
  				<option data-content="<span class='label label-default'>Gris</span>" value="default" {{ $data ? (($data->clase == 'default') ? 'selected' : '') : '' }}>Gris</option>
  			</select>
  		</div>		   
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="icono">&Iacute;cono</label>
			<div class="col-sm-4">
  			<select name="icono" class="selectpicker form-control">
  				<option data-content="<i class='fa fa-file-text-o fa-lg'></i>" value="fa-file-text-o"  {{ $data ? (($data->icono == 'fa-file-text-o') ? 'selected' : '') : '' }}></option>
  				<option data-content="<i class='fa fa-globe fa-lg'></i>" value="fa-globe"  {{ $data ? (($data->icono == 'fa-globe') ? 'selected' : '') : '' }}></option>
  				<option data-content="<i class='fa fa-anchor fa-lg'></i>" value="fa-anchor"  {{ $data ? (($data->icono == 'fa-anchor') ? 'selected' : '') : '' }}></option>
  				<option data-content="<i class='fa fa-cloud fa-lg'></i>" value="fa-cloud"  {{ $data ? (($data->icono == 'fa-cloud') ? 'selected' : '') : '' }}></option>
  				<option data-content="<i class='fa fa-pie-chart fa-lg'></i>" value="fa-pie-chart"  {{ $data ? (($data->icono == 'fa-pie-chart') ? 'selected' : '') : '' }}></option>
  				<option data-content="<i class='fa fa-users fa-lg'></i>" value="fa-users"  {{ $data ? (($data->icono == 'fa-users') ? 'selected' : '') : '' }}></option>
  			</select>
  		</div>		   
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<div class="checkbox">
			    <label>
			      <input type="checkbox" value="1" name="activo"> Activo
			    </label>
		    </div>
		  </div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{{ Form::submit('Guardar', array('class'=>'btn btn-primary')) }}
		  </div>
		</div>
	{{ Form::close() }}

	<script type="text/javascript">
		$(function() {
			$('.catalogoFecha').datetimepicker();
			$('.selectpicker').selectpicker();
			$('#frmCrud').bootstrapValidator({
				message: 'Revisar campo',
				feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        }
			});
		});
	</script>
@stop
