@extends('template/home')
@section('content')
	{{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::style('packages/csgt/components/css/bootstrapValidator.min.css') }}
  {{ HTML::style('packages/csgt/components/css/bootstrap-select.min.css') }}

  {{ HTML::script('packages/csgt/components/js/bootstrap-select.min.js') }}
	{{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}
  {{ HTML::script('packages/csgt/components/js/bootstrapValidator.min.js') }}
  {{ HTML::script('packages/csgt/components/js/bootstrapValidatorExtra.js') }}
	<?php
    $params = array('id'=>'frmRegistro','class'=>'form-horizontal', 'files'=>true);
    if ($route) $params['route'] = $route;
  ?>
	{{Form::open($params) }}
	<div class="contenido">
    <h1 class="titulo">Solicitud de inscripción</h1>
		<div class="col-md-12">
			<h4 class="titulo">Datos Generales</h4>
		</div>
    <!-- nit -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNIT" class="col-sm-4 control-label">1. NIT</label>
        <div class="col-sm-8">
          {{ Form::text('txNIT', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El NIT es requerido',
            'data-bv-nit'              => 'true',
            'autocomplete'             => 'off',
            'data-bv-remote'           => 'true',
            'data-bv-remote-url'       => '/signup/checkNIT',
            'data-bv-remote-message'   => 'NIT ya existe en la base de datos',
            'data-bv-remote-type'      => 'POST'
            )) }}
        </div>
      </div>
    </div>
		<!-- razon social -->
	  <div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">2. Razón Social</label>
        <div class="col-sm-10">
          {{ Form::text('txRazonSocial', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'La razón social es requerida',
            'autocomplete'             => 'off',
            'placeholder'              => 'Nombre, denominación o razón social de la empresa'
            )) }}
        </div>
      </div>
    </div>
    <!-- representante legal  -->
		<div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">3. Representante Legal</label>
        <div class="col-sm-10">
          {{ Form::text('txPropietario', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El representante legal es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Nombre del propietario o representante legal'
            )) }}
        </div>
      </div>
    </div>
    <!-- email -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">4. Email</label>
        <div class="col-sm-10">
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
    <!-- telefono -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txTelefono" class="col-sm-4 control-label">5. Teléfono</label>
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
        <label for="txFax" class="col-sm-4 control-label">6. FAX</label>
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
        <label for="txPassword" class="col-sm-4 control-label">7. Contrase&ntilde;a</label>
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
        <label for="txNombre" class="col-sm-4 control-label">8. Domicilio Fiscal</label>
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
        <label for="txNombre" class="col-sm-4 control-label">9. Domicilio Comercial</label>
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
        <label for="txDireccionNotificaciones" class="col-sm-4 control-label">10. Lugar para recibir notificaciones</label>
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
        <label for="txNombre" class="col-sm-4 control-label">11. Nombre del Contacto</label>
        <div class="col-sm-8">
          {{ Form::text('txEncargadoImportaciones', '', array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El nombre del contacto es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Importacion/exportacion'
            )) }}
        </div>
      </div>
    </div> 
    <!--tratados -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="tratados" class="col-sm-2 control-label">12. Acuerdo Comercial</label>
        <div class="col-sm-10 div-tratados">
          <select name="tratados" class="selectpicker form-control" id="tratados">
            @foreach($tratados as $tratado)
              <option value="{{ Crypt::encrypt($tratado->tratadoid) }}">{{ $tratado->nombrecorto }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <!-- contingente -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="cmbContingente" class="col-sm-2 control-label">13. Contingente</label>
        <div class="col-sm-10 div-contingente" id="div-contingente"></div>
      </div>
    </div>
    <!-- codigo VUPE -->
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="txVUPE" class="col-sm-2 control-label">14. Código VUPE</label>
        <div class="col-sm-10">
          {{ Form::text('txVUPE', '', array('class'=>'form-control', 
            'autocomplete' => 'off',
            'placeholder'  => 'Unicamente requerido para exportación de desperdicios y desechos de metales'
            )) }}
        </div>
      </div>
    </div>  

		<div class="clearfix"></div>
		<div class="col-md-12">
			<h4 class="titulo">Requerimientos</h4>
		  A continuación se enumeran los documentos que deben adjuntarse para aplicar a un contigente arancelario.
		  <hr>
		  <div class="requerimientos">
		    
		  </div>
		</div>
    <div class="clearfix"></div>
    <div class="col-md-12 text-center">
    	<input type="submit" class="btn btn-large btn-primary" value="Enviar solicitud de inscripci&oacute;n">
    </div>
    <div class="clearfix"></div>
	</div>
	{{Form::close()}}
	<script>
      $(document).ready(function(){
        $('#frmRegistro')
          .bootstrapValidator({
            excluded: ':disabled',
            feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
        })
        .on('error.field.bv', function(e, data) {
          data.bv.disableSubmitButtons(false);
        })
        .on('success.field.bv', function(e, data) {
          data.bv.disableSubmitButtons(false);
        });

        $('#tratados').change(function(){
          $.get('contingentes/tratado/' + $(this).val(), function(data){
            $('#div-contingente').html(data);
            $('#cmbContingente').change();
          });
        });

        $('#tratados').change();
      });

      $(document).on('change', '#cmbContingente', function(){

        $('.nuevos').each(function( index ) {
          $('#frmRegistro').bootstrapValidator('removeField', $(this).attr('id')); 
          console.log($(this).attr('id'));
        });

        $('.nuevos').remove();

        $.get('/requerimientos/contingentes/' + $(this).val() + '/inscripcion', function(data){
            $.each(data, function(key, datos){
              $.get('/requerimientos/contingentes/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
                $('.requerimientos').append(template);
                $('#frmRegistro').bootstrapValidator('addField', 'file' + datos.requerimientoid);
                $(".file").fileinput({
                  browseLabel: "Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                  browseClass: "btn btn-default",
                  showPreview: false,
                  showRemove:  false,
                  showUpload:  false,
                  allowedFileExtensions: ['jpg', 'png', 'pdf'],
                  msgInvalidFileExtension: 'Solo se permiten archivos jpg, png o pdf',
                  msgValidationError : 'Solo se permiten archivos jpg, png o pdf',
                });
              });     
            });       
        });
      });
    </script>
@stop