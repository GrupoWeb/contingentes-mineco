@extends('template/inscripcion')
@section('content')
	{{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
	{{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}

	<?php
    $params = array('id'=>'frmRegistro','class'=>'form-horizontal', 'files'=>true);
    if ($route) $params['route'] = $route;
  ?>
	{{Form::open($params) }}
	<div class="contenido">
		<div class="col-md-12">
			<h4 class="main">Datos Generales</h4>
		</div>
		<!-- nombre -->
		<div class="col-md-12">
	    <div class="form-group">
	      <label for="txNombre" class="col-sm-2 control-label">Nombre</label>
	      <div class="col-sm-10">
	        {{ Form::text('txNombre', '', array('class'=>'form-control', 
	          'data-bv-notEmpty'         =>'true',
	          'data-bv-notEmpty-message' => 'El nombre es requerido',
	          'autocomplete'             => 'off'
	          )) }}
	      </div>
	    </div>
	  </div>	
		<!-- razon social -->
	  <div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">Razón Social</label>
        <div class="col-sm-10">
          {{ Form::text('txRazonSocial', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'La razón social es requerida',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>
    <!-- representante legal  -->
		<div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">Representante Legal</label>
        <div class="col-sm-10">
          {{ Form::text('txPropietario', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El representante legal es requerido',
            'autocomplete'             => 'off',
            )) }}
        </div>
      </div>
    </div>
    <!-- email -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="email" class="col-sm-4 control-label">Email</label>
        <div class="col-sm-8">
          {{ Form::text('email', '', array(
            'class'                        => 'form-control',
            'data-bv-notEmpty'             => 'true',
            'data-bv-notEmpty-message'     => 'El email es requerido',
            'data-bv-emailaddress'         => 'true',
            'data-bv-emailaddress-message' => 'Email con formato incorrecto',
            'data-bv-remote'               => 'true',
            'data-bv-remote-url'           => '/signup/checkEmail',
            'data-bv-remote-message'       => 'Email ya existe en la base de datos',
            'data-bv-remote-type'          => 'POST'
          )) }}
        </div>
      </div>
    </div>
    <!-- nit -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNIT" class="col-sm-4 control-label">NIT</label>
        <div class="col-sm-8">
          {{ Form::text('txNIT', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El NIT es requerido',
            'data-bv-nit'              => 'true',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>
    <!-- telefono -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txTelefono" class="col-sm-4 control-label">Teléfono</label>
        <div class="col-sm-8">
          {{ Form::text('txTelefono', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El teléfono es requerido',
            'data-bv-integer'          => 'true',
            'data-bv-integer-message'  => 'Debe ser un número',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>   
    <!-- fax -->    
    <div class="col-md-6">
      <div class="form-group">
        <label for="txFax" class="col-sm-4 control-label">FAX</label>
        <div class="col-sm-8">
          {{ Form::text('txFax', '', array('class'=>'form-control', 
            'data-bv-integer' => 'true',
            'data-bv-integer-message' => 'Debe ser un número',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>    
    <!--password --> 
    <div class="col-md-6">
      <div class="form-group">
        <label for="txPassword" class="col-sm-4 control-label">Contrase&ntilde;a</label>
        <div class="col-sm-8">
          {{ Form::password('txPassword', array(
            'class'                        =>'form-control', 
            'placeholder'                  => 'M&iacute;nimo 6 caracteres',
            'data-bv-notempty'             => 'true',
            'data-bv-notempty-message'     => 'Contrase&ntilde;a es requerida',
            'data-bv-stringlength'         => 'true',
            'data-bv-stringlength-min'     => '6',
            'data-bv-stringlength-message' => 'La contrase&ntilde;a debe tener al menos 6 caracteres.',
            'data-bv-identical'            => 'true',
            'data-bv-identical-field'      => 'txPasswordrepeat',
            'data-bv-identical-message'    => 'Las contrase&ntilde;as no concuerdan'
          )) }}
        </div>
      </div>
    </div>
    <!--password2 -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txPasswordrepeat" class="col-sm-4 control-label">&nbsp;</label>
        <div class="col-sm-8">
          {{ Form::password('txPasswordrepeat', array(
            'class'                     => 'form-control', 
            'placeholder'               => 'Repetir contrase&ntilde;a',
            'data-bv-notempty'          => 'true', 
            'data-bv-notempty-message'  => 'Contrase&ntilde;a es requerida',
            'data-bv-identical'         => 'true',
            'data-bv-identical-field'   => 'txPassword',
            'data-bv-identical-message' => 'Las contrase&ntilde;as no concuerdan'
          )) }}
        </div>
      </div>
    </div>
    <!--domicilio fiscal -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">Domicilio Fiscal</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDomicilioFiscal', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El domicilio fiscal es requerido',
            'autocomplete'             => 'off',
            'rows'                     => 3,
            )) }}
        </div>
      </div>
    </div>
    <!--domicilio comercial -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">Domicilio Comercial</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDomicilioComercial', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El domicilio comercial es requerido',
            'autocomplete'             => 'off',
            'rows'                     => 3,
            )) }}
        </div>
      </div>
    </div>
    <!-- lugar -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txDireccionNotificaciones" class="col-sm-4 control-label">Lugar para recibir notificaciones</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDireccionNotificaciones', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El lugar para recibir notificaciones es requerido',
            'autocomplete'             => 'off',
            'rows'                     => '3',
            )) }}
        </div>
      </div>
    </div>
    <!--encargado -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">Encargado</label>
        <div class="col-sm-8">
          {{ Form::text('txEncargadoImportaciones', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El nombre del encargado es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Importaciones/exportaciones'
            )) }}
        </div>
      </div>
    </div>
    <!--contingentes -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="contingentes" class="col-sm-2 control-label">Contingente(s)</label>
        <div class="col-sm-10 div-contingente">
          <?php $grupoActual = 'primero'; ?>
          <select name="contingentes[]" class="selectpicker form-control" id="contingentes" 
          	multiple="true" 
          	title="Seleccione uno o varios">
            @foreach($contingentes as $contingente)
              @if($contingente->tratado <> $grupoActual)
                @if($grupoActual <> 'primero')
                  </optgroup>
                @endif
                <optgroup label="{{ $contingente->tipo}} | {{$contingente->tratado}}">
                <?php $grupoActual = $contingente->tratado; ?>  
              @endif
              <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
            @endforeach
            </optgroup>
          </select>
        </div>
      </div>
    </div>
		<div class="clearfix"></div>
		<div class="col-md-12">
			<h4 class="main">Requerimientos</h4>
		  A continuación se enumeran los requerimientos para todos los contingentes seleccionados.
		  <hr>
		  <div class="requerimientos">
		    
		  </div>
		</div>
    <div class="clearfix"></div>
    <div class="col-md-12 text-center">
    	<input type="submit" class="btn btn-large btn-primary" value="Solicitud de inscripci&oacute;n">
    </div>
    <div class="clearfix"></div>
	</div>
	{{Form::close()}}
	<script>
      $(document).ready(function(){
        $("#contingentes").change(function() {
          $('.nuevos').remove();
          $('#frmRegistro').bootstrapValidator('revalidateField', 'contingentes');
          $.get('/requerimientos/contingentes/' + $(this).val() + '/inscripcion', function(data){
              $.each(data, function(key, datos){
                $.get('/requerimientos/contingentes/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
                  $('.requerimientos').append(template);
                  $('#frmRegistro').bootstrapValidator('addField', 'file' + datos.requerimientoid);
                  $(".file").fileinput(
                  	{
                  		browseLabel: "Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                  		browseClass: "btn btn-default",
                  		showPreview: false,
                  		showRemove: false,
                  		showUpload: false,
                  		allowedFileExtensions: ['jpg', 'png', 'pdf'],
                  		msgInvalidFileExtension: 'Solo se permiten archivos jpg, png o pdf',
                  		msgValidationError : 'Solo se permiten archivos jpg, png o pdf',
                  	});
                });     
              });       
          });
        });
    
        $('#contingentes').selectpicker();
        $('#frmRegistro')
          .bootstrapValidator({
            excluded: ':disabled',
            feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              contingentes: {
                validators: {
                  callback: {
                    message: 'Porfavor seleccione al menos un contingente',
                    callback: function(value, validator, $field) {
                      var options = validator.getFieldElements('contingentes').val();
                      return (options !=null && options.length >=1);
                    }
                  }
                }
              }
            },
        })
        .on('error.field.bv', function(e, data) {
          data.bv.disableSubmitButtons(false);
        })
        .on('success.field.bv', function(e, data) {
          data.bv.disableSubmitButtons(false);
        });
      $('#contingentes').change();
      });
    </script>
@stop